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
    private int $timesViewed;
    private int $averageRate;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    private function __construct(
        MovieId $id,
        string $slug,
        string $title,
        string $originalTitle,
        string $providerId,
        \DateTime $releaseDate,
        string $overview,
        string $image,
        int $timesViewed,
        int $averageRate,
        \DateTime $createdAt,
        \DateTime $updatedAt
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
        $this->timesViewed = $timesViewed;
        $this->averageRate = $averageRate;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
            0,
            0,
            new \DateTime(),
            new \DateTime()
        );
    }

    private static function createSlugFromTitle(string $title): string
    {
        $tmpSlug = str_replace(' ', '-', strtolower($title));
        $search = ['á','é','í','ó','ú','à','è','ì','ò','ù','ä','ë','ï','ö','ü','â','ê','î','ô','û'];
        $replace = ['a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u'];
        $tmpSlug = str_replace($search, $replace, $tmpSlug);

        $slug = '';
        for ($i = 0 ; $i < strlen($tmpSlug) ; $i++) {
            $char = substr($tmpSlug, $i, 1);
            if (ord($char) == 45 || (ord($char) >= 48 && ord($char) <= 57)) {
                $slug .= substr($tmpSlug, $i, 1);
            }
            if ((ord($char) >= 65 && ord($char) <= 90) || (ord($char) >= 97 && ord($char) <= 122)) {
                $slug .= substr($tmpSlug, $i, 1);
            }
        }

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

    public function getTimesViewed(): int
    {
        return $this->timesViewed;
    }

    public function getAverageRate(): int
    {
        return $this->averageRate;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    // Actions
    public function increaseViews(): Movie
    {
        $this->timesViewed ++;

        return $this;
    }
}

