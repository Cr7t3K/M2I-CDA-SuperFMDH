<?php

namespace App\Controller;

use App\Entity\TransactionType;
use App\Form\TransactionTypeType;
use App\Repository\TransactionTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsCsrfTokenValid;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/transaction-type', name: 'app_transaction_type_')]
class TransactionTypeController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function index(TransactionTypeRepository $transactionTypeRepository): Response
    {
        $transactionTypes = $transactionTypeRepository->findAll();

        return $this->render('transactionType/index.html.twig', [
            'transactionTypes' => $transactionTypes,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $transactionType = new TransactionType();
        $form = $this->createForm(TransactionTypeType::class, $transactionType);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transactionType);
            $entityManager->flush();

            return $this->redirectToRoute('app_transaction_type_list');
        }


        return $this->render('transactionType/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/update/{id}', name: 'update')]
    public function update(
        Request $request,
        TransactionType $transactionType,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(TransactionTypeType::class, $transactionType);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($transactionType);
            $entityManager->flush();

            return $this->redirectToRoute('app_transaction_type_list');
        }

        return $this->render('transactionType/update.html.twig', [
            'form' => $form,
            'transactionType' => $transactionType
        ]);
    }

//    #[IsCsrfTokenValid(new Expression('"delete-transactionType" ~ args["transactionType"].getId()'), '_token')]
    #[Route('/remove/{id}', name: 'remove', methods: ['POST'])]
    public function remove(
        Request $request,
        #[MapEntity(id: 'id')] TransactionType $transactionType,
        EntityManagerInterface $entityManager
    ): Response {
        $token = $request->getPayload()->get('_token');

        if ($this->isCsrfTokenValid('remove-transactionType' . $transactionType->getId(), $token))
        {
            $entityManager->remove($transactionType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_transaction_type_list');
    }

}
