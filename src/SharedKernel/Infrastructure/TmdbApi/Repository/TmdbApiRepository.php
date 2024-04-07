<?php

namespace CommonPlatform\SharedKernel\Infrastructure\TmdbApi\Repository;

use CommonPlatform\SharedKernel\Application\Repository\ProviderRepositoryInterface;
use CommonPlatform\SharedKernel\Application\Dto\SearchMovieDto;
use CommonPlatform\SharedKernel\Application\Dto\SearchMovieResponseDto;
use TMDb;

class TmdbApiRepository implements ProviderRepositoryInterface
{
    private ?TMDb $handler = null;

    private function initHandler(): void
    {
        if (null === $this->handler) {
            $this->handler = new TMDb($_ENV['TMDB_KEY']);
        }
    }

    public function searchMovie(string $title, int $page = 1): SearchMovieResponseDto
    {
        $searchMovieList = [];
        
        $this->initHandler();

        $searchResponse = $this->handler->searchMovie($title, $page, FALSE, NULL, 'es');

        if (!empty($searchResponse)) {
            foreach ($searchResponse['results'] as $movie) {
                $searchMovieList[] = new SearchMovieDto(
                    $movie['id'],
                    $movie['title'],
                    $movie['original_title'],
                    $movie['release_date'] ?? null,
                    $movie['overview'],
                    $movie['poster_path'],
                );
            }
        }

        return new SearchMovieResponseDto($searchMovieList, $searchResponse['page'], $searchResponse['total_pages'], $searchResponse['total_results']);
    }

    public function findMovieByProviderId(string $providerId): ?SearchMovieDto
    {
        $this->initHandler();

        $searchResponse = $this->handler->getMovie($providerId, 'es');

        if (empty($searchResponse)) {
            return null;
        }

        $profileImagePath = $this->handler->getImageUrl($searchResponse['poster_path'], TMDb::IMAGE_PROFILE, 'w185');
        $backdropImagePath = $this->handler->getImageUrl($searchResponse['backdrop_path'], TMDb::IMAGE_BACKDROP, 'w780');


        return new SearchMovieDto(
            $searchResponse['id'],
            $searchResponse['title'],
            $searchResponse['original_title'],
            $searchResponse['release_date'],
            $searchResponse['overview'],
            $profileImagePath,
            $backdropImagePath,
        );
    }
}
