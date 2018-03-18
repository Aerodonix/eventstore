<?php
declare(strict_types=1);
namespace messanger\eventstore;

interface EventStore
{
    public function store(Event $event): void;
}
