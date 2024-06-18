<?php

namespace CommonPlatform\Context\App\Infrastructure\UI\Controller;

use CommonPlatform\Context\App\Application\Query\SearchMovieFromProviderQuery;
use CommonPlatform\SharedKernel\Infrastructure\Messenger\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchMovieController extends AbstractController
{
    private QueryBus $messageBus;

    public function __construct(QueryBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function index(): Response
    {
        return new JsonResponse(['status' => 'ok', 'message' => 'hello world']);
    }

    public function getMovie(Request $request): Response
    {
        $title = $request->query->get('title');
        $page = $request->query->get('page') ?? 1;

        if (empty($title)) {
            return new JsonResponse();
        }

        $searchMovieList= $this->messageBus->dispatch(
            new SearchMovieFromProviderQuery($title, $page)
        );

        #foreach ($searchMovieList->getData() as $movie) {
        #    //echo '<img src= "https://www.themoviedb.org/t/p/w220_and_h330_face/' . $movie->getProfileImagePath() . '" /><br><br>';
        #    echo '<img src= "https://media.themoviedb.org/t/p/w94_and_h141_bestv2/' . $movie->getProfileImagePath() . '" /><br><br>';
        #}die;

        return new JsonResponse($searchMovieList->toArray());
    }
}

