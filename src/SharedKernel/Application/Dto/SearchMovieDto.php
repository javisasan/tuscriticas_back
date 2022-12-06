<?php

namespace CommonPlatform\SharedKernel\Application\Dto;

class SearchMovieDto
{
    private string $id;
    private string $title;
    private string $originalTitle;
    private string $releaseDate;
    private ?string $overview;
    private ?string $image;

    public function __construct(
        string $id,
        string $title,
        string $originalTitle,
        string $releaseDate,
        ?string $overview,
        ?string $image
    ){
        $this->id = $id;
        $this->title = $title;
        $this->originalTitle = $originalTitle;
        $this->releaseDate = $releaseDate;
        $this->overview = $overview;
        $this->image = $image;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
}
