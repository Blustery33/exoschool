<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Loisir;
use App\Form\AddLoisirUserType;
use App\Repository\LoisirRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil', name: 'profil_')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('profil/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'new_loisir')]
    public function newLoisir(\Symfony\Component\HttpFoundation\Request $request): Response
    {

        $loisir = new Loisir();
        $loisir->getUsers(['1']);
        $form = $this->createForm(AddLoisirUserType::class, $loisir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $loisir->setActivities($loisir->getActivities());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loisir);
            $entityManager->flush();

            return $this->redirectToRoute('profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil/addLoisirUser.html.twig', [
            'loisir' => $loisir,
            'form' => $form->createView(),
        ]);
    }
}
