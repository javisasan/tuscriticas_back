<?php

namespace CommonPlatform\Context\App\Domain\Entity;

use CommonPlatform\Context\App\Domain\ValueObject\MovieId;

class Movie
{
    private string $id;
    private string $slug;
    private string $title;
    private string $originalTitle;
    private string $providerId;
    private \DateTime $releaseDate;
    private string $overview;
    private string $image;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private int $timesViewed;

    private function __construct(
        MovieId $id,
        string $slug,
        string $title,
        string $originalTitle,
        string $providerId,
        \DateTime $releaseDate,
        string $overview,
        string $image,
        \DateTime $createdAt,
        \DateTime $updatedAt,
        int $timesViewed
    )
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->title = $title;
        $this->originalTitle = $originalTitle;
        $this->providerId = $providerId;
        $this->releaseDate = $releaseDate;
        $this->overview = $overview;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->timesViewed = $timesViewed;
    }

    public static function create(
        string $title,
        string $originalTitle,
        string $providerId,
        \DateTime $releaseDate,
        string $overview,
        string $image
    ): self
    {
        return new self(
            new MovieId(),
            self::createSlugFromTitle($title),
            $title,
            $originalTitle,
            $providerId,
            $releaseDate,
            $overview,
            $image,
            new \DateTime(),
            new \DateTime(),
            0
        );
    }

    private static function createSlugFromTitle(string $title): string
    {
        $slug = str_replace(' ', '-', strtolower($title));
        $search = ['á','é','í','ó','ú','à','è','ì','ò','ù','ä','ë','ï','ö','ü','â','ê','î','ô','û'];
        $replace = ['a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u'];
        $slug = str_replace($search, $replace, $slug);

        return $slug;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    public function getProviderId(): string
    {
        return $this->providerId;
    }

    public function getReleaseDate(): \DateTime
    {
        return $this->releaseDate;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function getTimesViewed(): int
    {
        return $this->timesViewed;
    }

    // Actions
    public function increaseViews(): Movie
    {
        $this->timesViewed ++;

        return $this;
    }
}

