<?php

namespace CommonPlatform\Context\App\Application\Query;

use CommonPlatform\Context\App\Domain\Entity\Movie;

class GetMovieQueryHandlerResponse
{
    private Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }
}
