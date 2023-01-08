<?php

namespace CommonPlatform\Context\App\Application\Command;

use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;

class AddMovieViewCommandHandler
{
    private MovieRepositoryInterface $repository;

    public function __construct(MovieRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AddMovieViewCommand $command): void
    {
        /** @var Movie */
        $movie = $this->repository->getMovieBySlug($command->getSlug());

        if (empty($movie)) {
            throw new NotFoundHttpException();
        }
        
        // Move to a command
        $movie->increaseViews();
        $this->repository->save($movie);
    }
}
