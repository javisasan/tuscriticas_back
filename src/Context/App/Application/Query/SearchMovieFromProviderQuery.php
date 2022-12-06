<?php

namespace CommonPlatform\Context\App\Application\Query;

class SearchMovieFromProviderQuery
{
    private string $title;
    private int $page;

    public function __construct(string $title, int $page)
    {
        $this->title = $title;
        $this->page = $page;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPage(): string
    {
        return $this->page;
    }
}

