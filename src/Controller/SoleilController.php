<?php

namespace App\Controller;

use App\Entity\Soleil;
use App\Form\SoleilType;
use App\Repository\SoleilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/soleil')]
final class SoleilController extends AbstractController
{
    #[Route(name: 'app_soleil_index', methods: ['GET'])]
    public function index(SoleilRepository $soleilRepository): Response
    {
        return $this->render('soleil/index.html.twig', [
            'soleils' => $soleilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_soleil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $soleil = new Soleil();
        $form = $this->createForm(SoleilType::class, $soleil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($soleil);
            $entityManager->flush();

            return $this->redirectToRoute('app_soleil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soleil/new.html.twig', [
            'soleil' => $soleil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soleil_show', methods: ['GET'])]
    public function show(Soleil $soleil): Response
    {
        return $this->render('soleil/show.html.twig', [
            'soleil' => $soleil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_soleil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Soleil $soleil, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoleilType::class, $soleil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_soleil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soleil/edit.html.twig', [
            'soleil' => $soleil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soleil_delete', methods: ['POST'])]
    public function delete(Request $request, Soleil $soleil, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soleil->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($soleil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_soleil_index', [], Response::HTTP_SEE_OTHER);
    }
}
