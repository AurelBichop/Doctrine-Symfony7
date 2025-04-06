<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        StarshipRepository $starshipRepository,
        #[Autowire(param: 'iss_location_cache_ttl')] $issLocationCacheTTL
    ): Response {
        //dd($issLocationCacheTTL);
        //dd($this->getParameter('iss_location_cache_ttl'));
        //dd($this->getParameter('kernel.project_dir'));
        $ships = $starshipRepository->findAll();
        $myShip = $ships[array_rand($ships)];


        return $this->render('main/homepage.html.twig', [
            'myShip' => $myShip,
            'ships' => $ships,
        ]);
    }
}
