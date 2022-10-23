<?php

namespace CommonPlatform\Context\App\Domain\Repository;

use CommonPlatform\Context\App\Domain\Entity\Movie;

interface MovieRepositoryInterface
{
    public function save(Movie $movie): void;
}

