<?php

namespace CommonPlatform\Context\App\Domain\Entity;

use CommonPlatform\Context\App\Domain\ValueObject\MovieId;

class Movie
{
    private MovieId $id;
    private string $title;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    private function __construct(MovieId $id, string $title)
    {
        $this->movieId = $id;
        $this->title = $title;
    }

    public static function create(string $title): self
    {
        return new self(
            new MovieId(),
            $title
        );
    }

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}

