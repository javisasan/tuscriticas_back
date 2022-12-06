<?php

namespace CommonPlatform\Context\App\Application\Query;

use CommonPlatform\SharedKernel\Application\Repository\ProviderRepositoryInterface;

class SearchMovieFromProviderQueryHandler
{
    private ProviderRepositoryInterface $repository;

    public function __construct(ProviderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearchMovieFromProviderQuery $query): SearchMovieFromProviderQueryHandlerResponse
    {
        $response = $this->repository->searchMovie($query->getTitle(), $query->getPage());

        return new SearchMovieFromProviderQueryHandlerResponse(
            $response->getData(),
            $response->getPage(),
            $response->getTotalPages(),
            $response->getTotalResults()
        );
    }
}
