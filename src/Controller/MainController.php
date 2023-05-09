<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MainController extends AbstractController
{
    #[Route('/accueil', name: 'main')]
    public function index(SessionInterface $session): Response
    {
        $username = $session->get('user_username');

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'username' => $username
        ]);
    }
}
