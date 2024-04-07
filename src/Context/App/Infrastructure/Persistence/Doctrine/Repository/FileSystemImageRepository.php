<?php

namespace CommonPlatform\Context\App\Infrastructure\Persistence\Doctrine\Repository;

use CommonPlatform\Context\App\Domain\Entity\Image;
use CommonPlatform\Context\App\Domain\Repository\ImageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class FileSystemImageRepository extends ServiceEntityRepository implements ImageRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function save(Image $image): void
    {
        $this->entityManager->persist($image);
        $this->entityManager->flush();
    }
}
