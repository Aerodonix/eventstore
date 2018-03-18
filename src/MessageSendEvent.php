<?php
declare(strict_types=1);
namespace messanger\eventstore;

class MessageSendEvent implements Event
{
    /**
     * @var Uuid
     */
    private $messageId;
    /**
     * @var string
     */
    private $message;

    public function __construct(
        Uuid $messageId,
        string $message
    ) {
        $this->messageId = $messageId;
        $this->message = $message;
    }

    public function messageId(): Uuid
    {
        return $this->messageId;
    }

    public function message(): String
    {
        return $this->message;
    }

    public function eventName(): string
    {
        return 'messageSend';
    }
}
