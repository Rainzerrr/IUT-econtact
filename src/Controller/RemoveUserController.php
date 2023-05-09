<?php

namespace App\Controller;

use App\Repository\FriendRequestsRepository;
use App\Repository\ContactsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemoveUserController extends AbstractController
{
    #[Route('/remove_user', name: 'remove_user')]
    public function index(UsersRepository $usersRepository, ContactsRepository $contactsRepository, FriendRequestsRepository $friendRequestsRepository, Request $request, EntityManagerInterface $entityManager): Response
    {   
        if ($request->get('user') == 'current'){
            $user = $usersRepository->find($request->getSession()->get('user_id'));
            $redirect = 'main';
        }
        else{
            $user = $usersRepository->find($request->get('user'));
            $redirect = 'admin';
        }

        $entityManager->remove($user);
        $entityManager->flush();

        $contacts1 = $contactsRepository->findBy(['user' => $request->getSession()->get('user_id')]);
        $contacts2 = $contactsRepository->findBy(['contact' => $request->getSession()->get('user_id')]);

        $friendRequests1 = $friendRequestsRepository->findBy(['transmitter' => $request->getSession()->get('user_id')]);
        $friendRequests2 = $friendRequestsRepository->findBy(['receiver' => $request->getSession()->get('user_id')]);

        foreach (array_merge($contacts1, $contacts2) as $contact) {
            $entityManager->remove($contact);
        }
        $entityManager->flush();

        foreach (array_merge($friendRequests1, $friendRequests2) as $friendRequest) {
            $entityManager->remove($friendRequest);
        }
        $entityManager->flush();

        return $this->redirectToRoute($redirect);
    }
}
