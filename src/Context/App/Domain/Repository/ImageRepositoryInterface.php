<?php

namespace CommonPlatform\Context\App\Domain\Repository;

use CommonPlatform\Context\App\Domain\Entity\Image;

interface ImageRepositoryInterface
{
    public function downloadProfileImageAndGetPath(string $providerPath, string $imageString): ?string;
    public function save(Image $image): void;
}
