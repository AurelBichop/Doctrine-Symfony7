<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        StarshipRepository $starshipRepository,
        #[Autowire(param: 'iss_location_cache_ttl')] $issLocationCacheTTL,
        Request $request,
    ): Response {
        // dd($issLocationCacheTTL);
        // dd($this->getParameter('iss_location_cache_ttl'));
        // dd($this->getParameter('kernel.project_dir'));
        $ships = $starshipRepository->findIncomplete();
        $ships->setMaxPerPage(5);
        $ships->setCurrentPage($request->query->getInt('page', 1));

        $myShip = $starshipRepository->findMyShip();

        return $this->render('main/homepage.html.twig', [
            'myShip' => $myShip,
            'ships' => $ships,
        ]);
    }
}
