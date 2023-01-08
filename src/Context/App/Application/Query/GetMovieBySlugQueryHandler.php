<?php

namespace CommonPlatform\Context\App\Application\Query;

use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetMovieBySlugQueryHandler
{
    private MovieRepositoryInterface $repository;

    public function __construct(MovieRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetMovieBySlugQuery $query): Movie
    {
        $response = $this->repository->getMovieBySlug($query->getSlug());

        if (empty($response)) {
            throw new NotFoundHttpException();
        }

        return $response;
    }
}
