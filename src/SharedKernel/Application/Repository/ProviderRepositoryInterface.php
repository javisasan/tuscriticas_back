<?php

namespace CommonPlatform\SharedKernel\Application\Repository;

use CommonPlatform\SharedKernel\Application\Dto\SearchMovieResponseDto;

interface ProviderRepositoryInterface
{
    public function searchMovie(string $title, int $page = 1): SearchMovieResponseDto;
}

