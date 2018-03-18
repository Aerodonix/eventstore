<?php
declare(strict_types=1);

namespace messanger\eventstore;

class FileSystemEventStore implements EventStore
{
    /**
     * @var array
     */
    private $events = [];
    /**
     * @var Filename
     */
    private $filename;

    public function __construct(Filename $filename)
    {
        $this->filename = $filename;
    }

    public function store(Event $event): void
    {
        $this->events[] = $event;
        $this->save($event);
    }

    private function save(Event $event): void
    {
        file_put_contents(
            $this->filename->asString(),
            serialize(
                [
                    Uuid::generate(),
                    serialize($event)
                ]
            ) . "\n",
            FILE_APPEND
        );
    }

    /**
     * @throws \Exception
     */
    public function readAfter(Uuid $eventId): array
    {
        $file = new \SplFileObject($this->filename->asString());
        foreach ($file as $key => $line) {
            if ($file->valid()) {
                $event = unserialize($file->current());
                if ($event[0]->asString() === $eventId->asString()) {
                    $file->next();
                    if (!empty($file->current())) {
                        $nextEvent = unserialize($file->current());
                        $nextEvent[1] = unserialize($nextEvent[1]);
                        return $nextEvent;
                    } else {
                        return [];
                    }
                }
            }
        }
        throw new \Exception(
            sprintf(
                'No event with given eventId "%s" given',
                $eventId->asString()
            )
        );
    }

    public function read(): array
    {
        $file = new \SplFileObject($this->filename->asString());
        foreach ($file as $key => $line) {
            if (!empty($file->current())) {
                $event = unserialize($file->current());
                $event[1] = unserialize($event[1]);
                return $event;
            }
        }
        return [];
    }
}
