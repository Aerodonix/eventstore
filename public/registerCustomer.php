<?php
declare(strict_types=1);

namespace messanger\eventstore;

define('DS', DIRECTORY_SEPARATOR);

require_once(__DIR__ . DS . '..' . DS . 'vendor' . DS . 'autoload.php');

try {
    $command = new SendMessageCommand(Message::fromString('the-message'));

    $command1 = new SendMessageCommand(Message::fromString('the-message-two'));

    $command2 = new SendMessageCommand(Message::fromString('the-message-three'));

    $filename = Filename::fromString(__DIR__ . '/../data/events.txt');

    $eventStore = new FileSystemEventStore($filename);
    $repository = new MessageRepository($eventStore);
    $handler = new SendMessageCommandHandler($repository);
    $handler->handle($command);
    $handler->handle($command1);
    $handler->handle($command2);
} catch (\Exception $e) {
    print_r($e->getMessage());
}
