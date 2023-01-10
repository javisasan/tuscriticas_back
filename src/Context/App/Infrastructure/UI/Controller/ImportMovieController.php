<?php

namespace CommonPlatform\Context\App\Infrastructure\UI\Controller;

use CommonPlatform\Context\App\Application\Command\CreateMovieCommand;
use CommonPlatform\Context\App\Application\Query\GetMovieByProviderIdQuery;
use CommonPlatform\Context\App\Domain\Entity\Movie;
use CommonPlatform\SharedKernel\Infrastructure\Messenger\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class ImportMovieController extends AbstractController
{
    private MessageBusInterface $bus;
    private QueryBus $messageBus;

    public function __construct(MessageBusInterface $bus, QueryBus $messageBus)
    {
        $this->bus = $bus;
        $this->messageBus = $messageBus;
    }

    public function index(): Response
    {
        return new JsonResponse(['status' => 'ok', 'hola' => 'hola mundo']);
    }

    public function importMovie(Request $request): Response
    {
        $providerId = $request->query->get('id');

        $this->bus->dispatch(
            new CreateMovieCommand($providerId)
        );

        $response = $this->messageBus->dispatch(
            new GetMovieByProviderIdQuery($providerId)
        );

        /** @var Movie */
        $movie = $response->getMovie();

        return new JsonResponse([
            'id' => $movie->getId(),
            'slug' => $movie->getSlug(),
            'providerId' => $movie->getProviderId()
        ]);
    }
}
