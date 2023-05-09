<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contacts;
use App\Entity\FriendRequests;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function showContact(EntityManagerInterface $entityManager, Request $request): Response
    {
        $userId = $request->getSession()->get('user_id');

        $contacts = $entityManager->getRepository(Contacts::class)->findAllContacts($userId);
        $friendRequests = $entityManager->getRepository(FriendRequests::class)->findAllFriendRequests($userId);
        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
            'friendrequests' => $friendRequests
        ]);
    }
}
