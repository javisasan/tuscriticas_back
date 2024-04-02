<?php

namespace CommonPlatform\Context\App\Domain\Repository;

use CommonPlatform\Context\App\Domain\Entity\Movie;

interface MovieRepositoryInterface
{
    public function getLatestMovies(int $page, int $itemsPerPage): array;
    public function getMovieById(string $id): Movie;
    public function getMovieBySlug(string $slug): ?Movie;
    public function getMovieByProviderId(string $providerId): ?Movie;
    public function save(Movie $movie): void;
}

