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

    /*
     // Script para descargar archivo con CURL
     $ch = curl_init($urlFrom);
     $fh = fopen($fullPath, "wb");
     if(!$fh) {
             die("No puedo generar archivos");
     }
     curl_setopt($ch, CURLOPT_FILE, $fh);
     curl_exec($ch);
     curl_close($ch);
     fclose($fh);
     */
    public function downloadProfileImageAndGetPath(?string $providerPath, string $imageString): ?string
    {
        if (empty($providerPath)) {
            return null;
        }

        $publicPath = __DIR__ . '/../../../../../../../public';
        $type = 'images/movie/profile';
        $subfolder = $this->getFirstChar($imageString);
        $fileName = substr($providerPath, -(strrpos($providerPath, '/') + 1));
        $localPath = sprintf(
            '%s/%s/%s',
            $publicPath,
            $type,
            $subfolder
        );

        if (!file_exists($localPath)) {
            mkdir($localPath, 0755, true);
        }

        copy($providerPath, $localPath . '/' . $fileName);

        return sprintf('%s/%s/%s', $type, $subfolder, $fileName);
    }

    private function getFirstChar($name): string {
        for ($i = 0 ; $i < strlen($name) ; $i++) {
            $char = strtolower($name[$i]);
            if ((ord($char) > 96) && (ord($char) < 123)) {
                return $char;
            }
        }

        return "other";
    }

    public function save(Image $image): void
    {
        $this->entityManager->persist($image);
        $this->entityManager->flush();
    }
}
