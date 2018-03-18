<?php
declare(strict_types=1);

namespace messanger\eventstore;


class Message
{
    /**
     * @var String
     */
    private $message;

    /**
     * @var MessageSendEvent
     */
    private $event;

    /**
     * @var Uuid
     */
    private $id;

    private function __construct(string $message, Uuid $id)
    {
        $this->isValid($message);
        $this->message = $message;
        $this->id = $id;
        $this->record();
    }

    public static function fromString(string $message): Message
    {
        return new self(
            $message,
            $id = Uuid::generate()
            );
    }

    public function messageId(): Uuid
    {
        return $this->id;
    }

    public function emmitEvent(): MessageSendEvent
    {
        return $this->event;
    }

    public function asString(): string
    {
        return (string)$this->message;
    }

    private function record(): void
    {
        $this->event = new MessageSendEvent($this->id, $this->message);
    }

    /**
     * @throws \Exception
     */
    private function isValid(string $message): void
    {
        if ($message === '') {
            throw new \Exception('Message can not be empty');
        }
    }
}