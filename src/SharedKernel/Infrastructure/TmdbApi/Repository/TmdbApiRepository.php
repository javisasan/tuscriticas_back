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

        $searchResponse = $this->handler->searchMovie($title, $page, $adult = FALSE, $year = NULL, $lang = 'es');

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
}
