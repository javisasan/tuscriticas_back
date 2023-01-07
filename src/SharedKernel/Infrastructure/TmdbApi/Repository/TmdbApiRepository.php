<?php

namespace CommonPlatform\SharedKernel\Infrastructure\TmdbApi\Repository;

use CommonPlatform\SharedKernel\Application\Repository\ProviderRepositoryInterface;
use CommonPlatform\SharedKernel\Application\Dto\SearchMovieDto;
use CommonPlatform\SharedKernel\Application\Dto\SearchMovieResponseDto;
use TMDb;

class TmdbApiRepository implements ProviderRepositoryInterface
{
    private $handler;

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
                    $movie['release_date'],
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

        return new SearchMovieDto(
            $searchResponse['id'],
            $searchResponse['title'],
            $searchResponse['original_title'],
            $searchResponse['release_date'],
            $searchResponse['overview'],
            $searchResponse['poster_path'],
        );
    }
}
