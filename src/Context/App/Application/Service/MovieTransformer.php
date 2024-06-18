<?php

namespace CommonPlatform\Context\App\Application\Service;

use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\SharedKernel\Domain\Service\ResponseTransformer;

class MovieTransformer implements ResponseTransformer
{
    private Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function transform(): array
    {
        $releaseDate = empty($this->movie->getReleaseDate()) ? null : $this->movie->getReleaseDate()->format('Y-m-d');

        return [
            'id' => $this->movie->getId(),
            'slug' => $this->movie->getSlug(),
            'title' => $this->movie->getTitle(),
            'originalTitle' => $this->movie->getOriginalTitle(),
            'providerId' => $this->movie->getProviderId(),
            'releaseDate' => $releaseDate,
            'overview' => $this->movie->getOverview(),
            'profileImage' => $this->movie->getProfileImage()->getPath(),
            'timesViewed' => $this->movie->getTimesViewed(),
            'averageRate' => $this->movie->getAverageRate(),
            'createdAt' => $this->movie->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $this->movie->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
