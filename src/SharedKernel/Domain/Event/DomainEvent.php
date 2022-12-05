<?php

namespace CommonPlatform\SharedKernel\Domain\Event;

interface DomainEvent
{
    public function getAggregateId(): string;

    public function getOccurredOn(): int;
}
