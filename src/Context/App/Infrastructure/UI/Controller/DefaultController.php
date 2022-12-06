<?php

namespace CommonPlatform\Context\App\Infrastructure\UI\Controller;

use CommonPlatform\Context\App\Application\Query\SearchMovieFromProviderQuery;
use CommonPlatform\SharedKernel\Infrastructure\Messenger\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    private QueryBus $messageBus;

    public function __construct(QueryBus $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function index(): Response
    {
        return new JsonResponse(['status' => 'ok', 'asdf' => 'fdsfsdfsdf']);
    }

    public function getMovie(): Response
    {
        $productSellerList = $this->messageBus->dispatch(
            new SearchMovieFromProviderQuery('Akira')
        );
        #dd($productSellerList, "asdfasdfasdf");

        foreach ($productSellerList['results'] as $movie) {
            echo '<img src= "https://www.themoviedb.org/t/p/w220_and_h330_face/' . $movie['poster_path'] . '" /><br>';
        }
        die("fin");
    }
}

