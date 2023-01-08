<?php

namespace CommonPlatform\Context\App\Infrastructure\UI\Controller;

use CommonPlatform\Context\App\Application\Query\GetMovieBySlugQuery;
use CommonPlatform\SharedKernel\Infrastructure\Messenger\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetMovieController extends AbstractController
{
    private QueryBus $messageBus;

    public function __construct(QueryBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function getMovie(string $slug): Response
    {
        $movie = $this->messageBus->dispatch(
            new GetMovieBySlugQuery($slug)
        );

        dd($movie);

        return new JsonResponse();
    }
}

