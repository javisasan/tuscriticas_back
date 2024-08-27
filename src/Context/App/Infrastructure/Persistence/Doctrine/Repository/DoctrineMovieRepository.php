<?php

namespace CommonPlatform\Context\App\Infrastructure\Persistence\Doctrine\Repository;

use CommonPlatform\Context\App\Domain\Entity\Image;
use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\Context\App\Domain\Repository\MovieRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineMovieRepository extends ServiceEntityRepository implements MovieRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function getLatestMoviesOld(int $page, int $itemsPerPage): array
    {
        $sql = "SELECT * FROM movies m ORDER BY m.created_at DESC";
        $stmt = $this->entityManager->getConnection()->prepare($sql);
        $result = $stmt->executeQuery();
        $queryResponse = $result->fetchAllAssociative();
        dd($queryResponse);

        return $queryResponse;
    }

    public function getLatestMovies(int $page, int $itemsPerPage): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('m')
            ->from(Movie::class, 'm')
            ->orderBy('m.createdAt', 'DESC')
            ->setFirstResult(($page - 1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage);

        $query = $qb->getQuery();
        $queryResponse = $query->getResult();

        return $queryResponse;
    }

    public function getMovieById(string $id): Movie
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function getMovieBySlug(string $slug): ?Movie
    {
        return $this->findOneBy(['slug' => $slug]);
    }

    public function getMovieByProviderId(string $providerId): ?Movie
    {
        return $this->findOneBy(['providerId' => $providerId]);
    }

    public function searchMovie(string $title): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('m.slug, m.title, m.releaseDate, i.path as image, m.averageRate')
            ->from(Movie::class, 'm')
            ->innerJoin(Image::class, 'i', 'WITH', $qb->expr()->eq('i.id', 'm.profileImage'))
            ->andWhere('m.title LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->setMaxResults(8);

        $query = $qb->getQuery();
        $queryResponse = $query->getResult();

        return $queryResponse;
    }

    public function save(Movie $movie): void
    {
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
    }
}
