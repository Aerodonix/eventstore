<?php
declare(strict_types=1);
namespace messanger\eventstore;

class SendMessageCommandHandler
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function handle(SendMessageCommand $command): Uuid
    {
        $message = $this->messageRepository->add($command->message());
        $this->messageRepository->commit();
        return $message->messageId();
    }
}
