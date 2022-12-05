<?php

namespace CommonPlatform\SharedKernel\Application\Repository;

interface ProviderRepositoryInterface
{
    public function searchMovie(string $title): array;
}

