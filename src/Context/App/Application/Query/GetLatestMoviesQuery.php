<?php

namespace CommonPlatform\Context\App\Application\Query;

class GetLatestMoviesQuery
{
    private int $page;
    private int $itemsPerPage;

    public function __construct(int $page = 1, $itemsPerPage = 10)
    {
        $this->page = $page;
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }
}
