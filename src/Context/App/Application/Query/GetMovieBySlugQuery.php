<?php

namespace CommonPlatform\Context\App\Application\Query;

class GetMovieBySlugQuery
{
    private string $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
