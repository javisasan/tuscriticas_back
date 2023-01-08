<?php

namespace CommonPlatform\Context\App\Application\Query;

class GetMovieByProviderIdQuery
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
