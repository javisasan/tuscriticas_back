<?php

namespace CommonPlatform\Context\App\Application\Query;

class GetLatestMoviesQueryHandlerResponse
{
    private array $movies;
    private int $page;

    public function __construct(array $movies, int $page = 1)
    {
        $this->movies = $movies;
        $this->page = $page;
    }

    public function getMovies(): array
    {
        return $this->movies;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
