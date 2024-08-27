<?php

namespace CommonPlatform\Context\App\Application\Command;

use CommonPlatform\Context\App\Domain\Entity\Image;
use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\Context\App\Domain\Repository\ImageRepositoryInterface;
use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;
use CommonPlatform\Context\App\Domain\Service\TitleSlugService;
use CommonPlatform\SharedKernel\Application\Repository\ProviderRepositoryInterface;

class CreateMovieCommandHandler
{
    private MovieRepositoryInterface $movieRepository;
    private ProviderRepositoryInterface $providerRepository;
    private ImageRepositoryInterface $imageRepository;

    public function __construct(
        MovieRepositoryInterface $movieRepository,
        ProviderRepositoryInterface $providerRepository,
        ImageRepositoryInterface $imageRepository
    ){
        $this->movieRepository = $movieRepository;
        $this->providerRepository = $providerRepository;
        $this->imageRepository = $imageRepository;
    }

    public function __invoke(CreateMovieCommand $command): void
    {
        $response = $this->providerRepository->findMovieByProviderId($command->getProviderId());

        if (empty($response)) {
            return;
        }

        if ($this->movieRepository->getMovieByProviderId($response->getId())) {
            return;
        }

        $titleSlug = new TitleSlugService($response->getTitle());

        $existingMovie = $this->movieRepository->getMovieBySlug($titleSlug->getSlug());

        /** @var Movie */
        $movie = Movie::create(
            $response->getTitle(),
            !$existingMovie ? $titleSlug->getSlug() : $titleSlug->getSlugWithRandomHash(),
            $response->getOriginalTitle(),
            $response->getId(),
            $response->getOverview(),
            $response->getReleaseDate(),
            null
        );

        $localProfileImagePath = $this->imageRepository->downloadProfileImageAndGetPath($response->getProfileImagePath(), $titleSlug->getSlug());
        $profileImage = Image::create($localProfileImagePath);

        $movie->setProfileImage($profileImage);

        $this->movieRepository->save($movie);
    }
}
