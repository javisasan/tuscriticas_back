<?php

namespace CommonPlatform\Context\App\Application\Command;

class CreateMovieCommand
{
    private string $providerId;

    public function __construct(string $providerId)
    {
        $this->providerId = $providerId;
    }

    public function getProviderId(): string
    {
        return $this->providerId;
    }
}

