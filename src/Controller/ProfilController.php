<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Loisir;
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
    /*#[ParamConverter('loisir', class: 'App\Entity\Loisir', options: ['LoisirId'=>'id'] )]
    #[Route('/loisir/{LoisirId}', name: 'loisir_show')]*/
   /**
     * @Route("/loisir/{loisirId}", name="loisir_show")
     * @ParamConverter("loisir", class="App\Entity\Loisir", options={"mapping": {"loisirId": "id"}})
     */
    public function getLoisir(UserRepository $userRepository): Response
    {
        $user = new User();
        $users = $userRepository->findAll();
        if($this->getUser() === $this->getUser()) {
            $user->getLoisirs();
        }
        return $this->render('profil/showLoisir.html.twig', [
            'users' => $users,
            'user' => $user,
        ]);


        /*if ($this->getUser() === $user->getUserIdentifier()) {

            return $this->render('profil/showLoisir.html.twig', [
                'user' => $user,
            ]);
        } else {
            $this->addFlash('danger', 'Vous n\'avez pas accès à cette page');
            return $this->redirectToRoute('profil_loisir_show');
        }*/
    }
}
