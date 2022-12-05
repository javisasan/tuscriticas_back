<?php

namespace CommonPlatform\SharedKernel\Infrastructure\Messenger\Event\Provider;

use CommonPlatform\SharedKernel\Domain\Event\DomainEvent;

interface ProvidesEvents
{
    /**
     * @return DomainEvent[]
     */
    public function releaseEvents();
}
