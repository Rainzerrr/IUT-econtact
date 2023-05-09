<?php

namespace App\Controller;

use App\Entity\Contacts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FriendRequestsRepository;
use Symfony\Component\HttpFoundation\Request;

class HandleFriendrequestController extends AbstractController
{
    #[Route('/handle_friendrequest', name: 'handle_friendrequest')]
    public function index(FriendRequestsRepository $friendRequestsRepository, EntityManagerInterface $entityManager, Request $request): Response
    {
        $friend = $request->get('friend');
        $status = $request->get('status');

        $friendrequest = $friendRequestsRepository->findOneBy(['receiver' => $request->getSession()->get('user_id'), 'transmitter' => intval($friend)]);

        $entityManager->remove($friendrequest);

        if ($status == 'approved') {
            $newContact = new Contacts();
            $newContact->setUser(intval($request->getSession()->get('user_id')));
            $newContact->setContact(intval($friend));
            $entityManager->persist($newContact);
            $entityManager->flush();

        }
        $entityManager->flush();

        return $this->redirectToRoute('contact');
    }
}
