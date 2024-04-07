<?php

namespace CommonPlatform\Context\App\Application\Service;

use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\SharedKernel\Domain\Service\ResponseTransformer;

class MovieListTransformer implements ResponseTransformer
{
    private array $movies;

    public function __construct(array $movies)
    {
        $this->movies = $movies;
    }

    public function transform(): array
    {
        $transformedArray = [];

        if (!empty($this->movies)) {
            /** @var Movie $movie */
            foreach ($this->movies as $movie) {
                $releaseDate = empty($movie->getReleaseDate()) ? null : $movie->getReleaseDate()->format('Y-m-d');

                $transformedArray[] = [
                    'id' => $movie->getId(),
                    'slug' => $movie->getSlug(),
                    'title' => $movie->getTitle(),
                    'originalTitle' => $movie->getOriginalTitle(),
                    'providerId' => $movie->getProviderId(),
                    'releaseDate' => $releaseDate,
                    'overview' => $movie->getOverview(),
                    'profileImage' => $movie->getProfileImage(),
                    'timesViewed' => $movie->getTimesViewed(),
                    'averageRate' => $movie->getAverageRate(),
                    'createdAt' => $movie->getCreatedAt()->format('Y-m-d H:i:s'),
                    'updatedAt' => $movie->getUpdatedAt()->format('Y-m-d H:i:s'),
                ];
            }
        }

        return $transformedArray;
    }
}
