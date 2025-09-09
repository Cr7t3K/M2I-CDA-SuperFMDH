<?php

namespace App\Controller;

use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function index(
        ListingRepository $listingRepository
    ): Response {
        $listings = $listingRepository->findAll();

        return $this->render('index.html.twig', [
                'listings' => $listings,
        ]);
    }
}
