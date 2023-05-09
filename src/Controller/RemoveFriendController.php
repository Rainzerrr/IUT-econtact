<?php

namespace App\Controller;

use App\Repository\ContactsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemoveFriendController extends AbstractController
{
    #[Route('/remove_friend', name: 'remove_friend')]
    public function index(ContactsRepository $contactsRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $friend = $request->get('friend');
        $contacts1 = $contactsRepository->findOneBy(['user' => $request->getSession()->get('user_id'), 'contact' => intval($friend)]);
        $contacts2 = $contactsRepository->findOneBy(['user' => intval($friend), 'contact' => $request->getSession()->get('user_id')]);
        if ($contacts1 == null) {
            $entityManager->remove($contacts2);
        } else {
            $entityManager->remove($contacts1);
        }
        $entityManager->flush();

        return $this->redirectToRoute('contact');
    }
}
