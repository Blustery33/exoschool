<?php

namespace App\Controller;

use App\Entity\Loisir;
use App\Form\LoisirType;
use App\Repository\LoisirRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/loisir')]
class LoisirController extends AbstractController
{
    #[Route('/', name: 'loisir_index', methods: ['GET'])]
    public function index(LoisirRepository $loisirRepository): Response
    {
        return $this->render('loisir/index.html.twig', [
            'loisirs' => $loisirRepository->findAll(),
        ]);

    }

    #[Route('/new', name: 'loisir_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $loisir = new Loisir();
        $form = $this->createForm(LoisirType::class, $loisir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loisir);
            $entityManager->flush();

            return $this->redirectToRoute('loisir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('loisir/new.html.twig', [
            'loisir' => $loisir,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'loisir_show', methods: ['GET'])]
    public function show(Loisir $loisir): Response
    {
        return $this->render('loisir/show.html.twig', [
            'loisir' => $loisir,
        ]);
    }

    #[Route('/{id}/edit', name: 'loisir_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Loisir $loisir): Response
    {
        $form = $this->createForm(LoisirType::class, $loisir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('loisir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('loisir/edit.html.twig', [
            'loisir' => $loisir,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'loisir_delete', methods: ['POST'])]
    public function delete(Request $request, Loisir $loisir): Response
    {
        if ($this->isCsrfTokenValid('delete'.$loisir->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($loisir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('loisir_index', [], Response::HTTP_SEE_OTHER);
    }
}
