<?php

namespace CommonPlatform\Context\App\Application\Query;

use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetMovieByProviderIdQueryHandler
{
    private MovieRepositoryInterface $repository;

    public function __construct(MovieRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetMovieByProviderIdQuery $query): GetMovieQueryHandlerResponse
    {
        $movie = $this->repository->getMovieByProviderId($query->getProviderId());

        if (empty($movie)) {
            throw new NotFoundHttpException();
        }
        
        return new GetMovieQueryHandlerResponse($movie);
    }
}
