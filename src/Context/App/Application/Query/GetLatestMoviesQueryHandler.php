<?php

namespace CommonPlatform\Context\App\Application\Query;

use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetLatestMoviesQueryHandler
{
    private MovieRepositoryInterface $repository;

    public function __construct(MovieRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetLatestMoviesQuery $query): GetLatestMoviesQueryHandlerResponse
    {
        $movies = $this->repository->getLatestMovies($query->getPage(), $query->getItemsPerPage());

        if (empty($movies)) {
            throw new NotFoundHttpException();
        }
        
        return new GetLatestMoviesQueryHandlerResponse($movies);
    }
}
