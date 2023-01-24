<?php

namespace CommonPlatform\Context\App\Infrastructure\UI\Controller;

use CommonPlatform\Context\App\Application\Command\AddMovieViewCommand;
use CommonPlatform\Context\App\Application\Query\GetLatestMoviesQuery;
use CommonPlatform\Context\App\Application\Query\GetMovieBySlugQuery;
use CommonPlatform\Context\App\Application\Service\MovieListTransformer;
use CommonPlatform\Context\App\Application\Service\MovieTransformer;
use CommonPlatform\SharedKernel\Infrastructure\Messenger\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class MovieController extends AbstractController
{
    private MessageBusInterface $bus;
    private QueryBus $messageBus;

    public function __construct(MessageBusInterface $bus, QueryBus $messageBus)
    {
        $this->bus = $bus;
        $this->messageBus = $messageBus;
    }

    public function getMovie(string $slug): Response
    {
        $this->bus->dispatch(
            new AddMovieViewCommand($slug)
        );

        $response = $this->messageBus->dispatch(
            new GetMovieBySlugQuery($slug)
        );

        $transformer = new MovieTransformer($response->getMovie());
        return new JsonResponse($transformer->transform());
    }

    public function getLatestMovies(): Response
    {
        $response = $this->messageBus->dispatch(
            new GetLatestMoviesQuery()
        );

        $transformer = new MovieListTransformer($response->getMovies());
        return new JsonResponse($transformer->transform());
    }
}

