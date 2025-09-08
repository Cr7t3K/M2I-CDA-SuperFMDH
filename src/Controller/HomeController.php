<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    public const PROPERTIES = [
        [
            'id' => 1,
            'title' => 'Charmant appartement T2',
            'description' => 'Bel appartement rénové avec goût, idéal pour un jeune couple ou étudiant. Proche du centre-ville et des transports.',
            'img' => '/uploads/properties/appartement1.jpg',
            'transaction' => 'rent',
            'price' => 750,
            'city' => 'Lyon',
        ],
        [
            'id' => 2,
            'title' => 'Maison familiale avec jardin',
            'description' => 'Grande maison de 120m² avec 4 chambres, garage double et jardin arboré. Quartier calme, proche des écoles.',
            'img' => '/uploads/properties/maison1.jpg',
            'transaction' => 'sale',
            'price' => 325000,
            'city' => 'Grenoble',
        ],
        [
            'id' => 3,
            'title' => 'Studio meublé moderne',
            'description' => 'Studio de 25m² entièrement équipé, cuisine ouverte, salle de bain neuve. Internet inclus dans le loyer.',
            'img' => '/uploads/properties/studio1.jpg',
            'transaction' => 'rent',
            'price' => 550,
            'city' => 'Chambéry',
        ]
    ];

    #[Route(path: '/', name: 'home')]
    public function index(): Response
    {

        return $this->render('index.html.twig', [
                'properties' => self::PROPERTIES,
        ]);
    }
}
