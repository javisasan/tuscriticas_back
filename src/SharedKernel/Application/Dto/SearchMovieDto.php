<?php

namespace CommonPlatform\SharedKernel\Application\Dto;

class SearchMovieDto
{
    private string $id;
    private string $title;
    private string $originalTitle;
    private ?\DateTime $releaseDate;
    private ?string $overview;
    private ?string $profileImagePath;
    private ?string $backdropImagePath;

    public function __construct(
        string $id,
        string $title,
        string $originalTitle,
        ?string $releaseDate,
        ?string $overview,
        ?string $profileImagePath,
        ?string $backdropImagePath
    ){
        $this->id = $id;
        $this->title = $title;
        $this->originalTitle = $originalTitle;
        $this->releaseDate = !empty($releaseDate) ? new \DateTime($releaseDate) : null;
        $this->overview = $overview;
        $this->profileImagePath = $profileImagePath;
        $this->backdropImagePath = $backdropImagePath;
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

    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function getProfileImagePath(): ?string
    {
        return $this->profileImagePath;
    }

    public function getBackdropImagePath(): ?string
    {
        return $this->backdropImagePath;
    }
}
