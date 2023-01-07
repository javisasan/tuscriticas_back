<?php

namespace CommonPlatform\Context\App\Infrastructure\UI\Controller;

use CommonPlatform\Context\App\Application\Command\CreateMovieCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class ImportMovieController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function index(): Response
    {
        return new JsonResponse(['status' => 'ok', 'hola' => 'hola mundo']);
    }

    public function importMovie(Request $request): Response
    {
        $providerId = $request->query->get('id');

        $this->messageBus->dispatch(
            new CreateMovieCommand($providerId)
        );

        return new JsonResponse(['status' => 'ok']);
    }
}
