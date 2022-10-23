<?php

namespace App\SharedKernel\Domain\Event;

interface DomainEvent
{
    public function getAggregateId(): string;

    public function getOccurredOn(): int;
}
