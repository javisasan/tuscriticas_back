<?php

namespace CommonPlatform\Context\App\Domain\Entity;

use CommonPlatform\Context\App\Domain\ValueObject\ImageId;

class Image
{
    private string $id;
    //private Movie $movieId;
    private string $path;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    private function __construct(
        ImageId $id,
        //Movie $movieId,
        string $path,
        \DateTime $createdAt,
        \DateTime $updatedAt
    )
    {
        $this->id = $id;
        //$this->movieId = $movieId;
        $this->path = $path;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        //Movie $movieId,
        string $path
    ): self
    {
        return new self(
            new ImageId(),
            //$movieId,
            $path,
            new \DateTime(),
            new \DateTime()
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    /*
    public function getMovieId(): Movie
    {
        return $this->movieId;
    }
     */

    public function getPath(): string
    {
        return $this->path;
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
