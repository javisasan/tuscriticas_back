<?php

namespace CommonPlatform\Context\App\Application\Query;

class SearchMovieQueryHandlerResponse
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    public function toArray(): array
    {
        $movieList = [];

        if (empty($this->data)) {
            return $movieList;
        }

        foreach ($this->data as $movie) {
            $releaseDate = !empty($movie['releaseDate']) ? $movie['releaseDate']->format('Y-m-d') : '';

            $movieList[] = [
                'slug' => $movie['slug'],
                'title' => $movie['title'],
                'year' => substr($releaseDate, 0, 4),
                'image' => $movie['image'],
                'averageRate' => $movie['averageRate'],
            ];
        }

        return $movieList;
    }
}
