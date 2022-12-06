<?php

namespace CommonPlatform\SharedKernel\Infrastructure\Repository;

use CommonPlatform\SharedKernel\Application\Repository\ProviderRepositoryInterface;
use TMDb;

class TmdbApiRepository implements ProviderRepositoryInterface
{
    private $handler;

    private function initHandler(): void
    {
        if (null === $this->handler) {
            $this->handler = new TMDb($_ENV['TMDB_KEY']);
        }
    }

    public function searchMovie(string $title, int $page = 1): array
    {
        $this->initHandler();

        return $this->handler->searchMovie($title, $page, $adult = FALSE, $year = NULL, $lang = 'es');
    }
}

