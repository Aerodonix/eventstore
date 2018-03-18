<?php
declare(strict_types=1);

namespace messanger\eventstore;

class MessageRepository
{
    /**
     * @var array
     */
    private $messages = [];
    /**
     * @var EventStore
     */
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function add(Message $message): Message
    {
        $singleMessage = Message::fromString($message->asString());
        $this->messages[$singleMessage->messageId()->asString()] = $singleMessage;
        return $singleMessage;
    }

    public function commit(): void
    {
        foreach($this->messages as $message) {
            $this->eventStore->store(
                $message->emmitEvent()
            );
        }
    }
}
