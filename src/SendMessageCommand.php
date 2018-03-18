<?php
declare(strict_types=1);
namespace messanger\eventstore;

class SendMessageCommand
{
    /**
     * @var Message
     */
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function message(): Message
    {
        return $this->message;
    }
}
