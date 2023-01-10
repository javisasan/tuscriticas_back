<?php

namespace CommonPlatform\Context\App\Application\Command;

use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;
use CommonPlatform\SharedKernel\Application\Repository\ProviderRepositoryInterface;

class CreateMovieCommandHandler
{
    private MovieRepositoryInterface $movieRepository;
    private ProviderRepositoryInterface $providerRepository;

    public function __construct(MovieRepositoryInterface $movieRepository, ProviderRepositoryInterface $providerRepository)
    {
        $this->movieRepository = $movieRepository;
        $this->providerRepository = $providerRepository;
    }

    public function __invoke(CreateMovieCommand $command): void
    {
        $response = $this->providerRepository->findMovieByProviderId($command->getProviderId());

        if (empty($response)) {
            return;
        }

        /** @var Movie */
        $movie = Movie::create(
            $response->getTitle(),
            $response->getOriginalTitle(),
            $response->getId(),
            $response->getReleaseDate(),
            $response->getOverview(),
            $response->getImage()
        );

        $this->movieRepository->save($movie);
    }
}
