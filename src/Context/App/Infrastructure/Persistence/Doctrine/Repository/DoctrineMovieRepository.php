<?php

namespace CommonPlatform\Context\App\Infrastructure\Persistence\Doctrine\Repository;

use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineMovieRepository extends ServiceEntityRepository implements MovieRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function getMovieById(string $id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function getMovieBySlug(string $slug)
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    public function getMovieByProviderId(string $providerId)
    {
        return $this->findOneBy(['providerId' => $providerId]);
    }

    public function save(Movie $movie): void
    {
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
    }
}

