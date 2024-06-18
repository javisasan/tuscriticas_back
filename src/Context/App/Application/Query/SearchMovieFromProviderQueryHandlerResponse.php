<?php

namespace CommonPlatform\Context\App\Application\Query;

class SearchMovieFromProviderQueryHandlerResponse
{
    private array $data;
    private int $page;
    private int $totalPages;
    private int $totalResults;

    public function __construct(array $data, int $page, int $totalPages, int $totalResults)
    {
        $this->data = $data;
        $this->page = $page;
        $this->totalPages = $totalPages;
        $this->totalResults = $totalResults;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    public function toArray(): array
    {
        $movieList = [];

        if (!empty($this->data)) {
            foreach ($this->data as $movie) {
                $releaseDate = !empty($movie->getReleaseDate()) ? $movie->getReleaseDate()->format('Y-m-d') : null;
                $movieList[] = [
                    'external_id' => $movie->getId(),
                    'title' => $movie->getTitle(),
                    'original_title' => $movie->getOriginalTitle(),
                    'release_date' => $releaseDate,
                    'overview' => $movie->getOverview(),
                    //'image' => $movie->getImage(),
                    'image' => $movie->getProfileImagePath(),
                ];
            }
        }

        return [
            'data' => $movieList,
            'page' => $this->page,
            'total_pages' => $this->totalPages,
            'total_results' => $this->totalResults
        ];
    }
}
