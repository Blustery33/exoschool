<?php

namespace App\Controller;

use App\Repository\LoisirRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(LoisirRepository $loisirRepository, UserRepository $userRepository): Response
    {
        /*$loisirs = $loisirRepository->findAll();*/
        $users = $userRepository->findAll();
        $user = $this->getUser();

        return $this->render('home/index.html.twig', [
            /*'loisirs' => $loisirs,*/
            'users' => $users,
            'user' => $user,
        ]);
    }
}
