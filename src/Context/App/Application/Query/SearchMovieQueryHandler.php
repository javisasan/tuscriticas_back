<?php

namespace CommonPlatform\Context\App\Application\Query;

use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;

class SearchMovieQueryHandler
{
    private MovieRepositoryInterface $repository;

    public function __construct(MovieRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchMovieQuery $query): SearchMovieQueryHandlerResponse
    {
        $result = $this->repository->searchMovie($query->getTitle());

        return new SearchMovieQueryHandlerResponse($result);
    }
}
