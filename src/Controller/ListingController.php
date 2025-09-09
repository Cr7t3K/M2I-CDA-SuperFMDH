<?php

namespace App\Controller;

use App\Entity\Listing;
use App\Entity\PropertyType;
use App\Entity\TransactionType;
use App\Repository\ListingRepository;
use App\Repository\PropertyTypeRepository;
use App\Repository\TransactionTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/listing', name: 'listing_')]
final class ListingController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    public function index(): Response
    {
        return $this->render('listing/index.html.twig');
    }

    //  /listing/19
    #[Route(
        path: '/{id}',
        name: 'show',
        requirements: ['id' => '\d+']
    )]
    public function show(
        #[MapEntity(id: 'id')] Listing $listing,
        ListingRepository $listingRepository
    ): Response {

        return $this->render('listing/show.html.twig', [
            'listing' => $listing,
        ]);
    }

    #[Route(
        path: '/new',
        name: 'new'
    )]
    public function new(
        EntityManagerInterface $entityManager,
        TransactionTypeRepository $transactionTypeRepository,
        PropertyTypeRepository $propertyTypeRepository
    ): Response {
        $propertyType = $propertyTypeRepository->findOneBy([]);
        $transactionType = $transactionTypeRepository->findOneBy([]);

        $listing = new Listing();
        $listing
            ->setTitle('Villa de luxe')
            ->setDescription('Villa de luxe description')
            ->setPrice(233244)
            ->setImg('ezfzef')
            ->setTransactionType($transactionType)
            ->setPropertyType($propertyType)
            ->setCity('Dubai')
        ;

        $entityManager->persist($listing);
        $entityManager->flush();

        return $this->redirectToRoute('listing_show', ['id' => $listing->getId()]);
    }

    #[Route(
        path: '/delete/{id}',
        name: 'delete',
        requirements: ['id' => '\d+']
    )]
    public function delete(
        #[MapEntity(id: 'id')] Listing $listing,
        EntityManagerInterface $entityManager
    ): Response {

        $entityManager->remove($listing);
        $entityManager->flush();

        return $this->redirectToRoute('home');
    }
}
