<?php

namespace CommonPlatform\Context\App\Infrastructure\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        return new JsonResponse(['status' => 'ok', 'asdf' => 'fdsfsdfsdf']);
    }

    public function getMovie(): Response
    {
        include_once('../../External/TMDb.php');
    }
}

