<?php

namespace CommonPlatform\Context\App\Application\Query;

class SearchMovieFromProviderQuery
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

