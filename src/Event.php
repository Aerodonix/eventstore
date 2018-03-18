<?php
declare(strict_types=1);
namespace messanger\eventstore;

interface Event
{
    public function eventName(): string;
}
