<?php

namespace CommonPlatform\SharedKernel\Application\Dto;

class SearchMovieResponseDto
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
}
