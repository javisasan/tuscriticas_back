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
        return [
            'id' => $this->movie->getId(),
            'slug' => $this->movie->getSlug(),
            'title' => $this->movie->getTitle(),
            'originalTitle' => $this->movie->getOriginalTitle(),
            'providerId' => $this->movie->getProviderId(),
            'releaseDate' => $this->movie->getReleaseDate()->format('Y-m-d'),
            'overview' => $this->movie->getOverview(),
            'image' => $this->movie->getImage(),
            'createdAt' => $this->movie->getCreatedAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $this->movie->getUpdatedAt()->format('Y-m-d H:i:s'),
            'timesViewed' => $this->movie->getTimesViewed(),
        ];
    }
}
