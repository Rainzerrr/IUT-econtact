<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Entity\FriendRequests;
use App\Form\AddUserType;
use App\Repository\ContactsRepository;
use App\Repository\FriendRequestsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function addFriend(Request $request, UsersRepository $usersRepository, ContactsRepository $contactsRepository, FriendRequestsRepository $friendRequestRepository, EntityManagerInterface $entityManager): Response
    {
        $user = null;
        $findUser = $this->createForm(AddUserType::class);
        $message = null;

        if ($findUser->handleRequest($request)->isSubmitted() && $findUser->isValid()) {
            $criteria = $findUser->getData();
            $user = $usersRepository->findByName($criteria);
            if (count($user) > 0) {
                $isFriend = $contactsRepository->findByFriend(intval($request->getSession()->get('user_id')), intval($user[0]->getId()));
                $alreadyFriendRequest = $friendRequestRepository->findOneBy(['receiver' => intval($user[0]->getId()), 'transmitter' => $request->getSession()->get('user_id')]);
                if (count($isFriend) > 0) {
                    $message = "Euhhhh... Vous êtes déjà amis !";
                } else {

                    if($alreadyFriendRequest != null){
                        $message = "Vous avez déja envoyé une demmande d'ami à cet utilisateur !";
                    }
                    elseif (intval($user[0]->getId() == $request->getSession()->get('user_id'))){
                        $message = "Vous ne pouvez pas vous ajouter vous même en ami voyons...";
                    }
                    else{
                        $newContact = new FriendRequests();
                        $newContact->setTransmitter(intval($request->getSession()->get('user_id')));
                        $newContact->setReceiver(intval($user[0]->getId()));
    
                        $entityManager->persist($newContact);
                        $entityManager->flush();
    
                        $message = "Demmande d'amis envoyé";
                    }
                }
            } else {
                $message = "Euhhhh... Votre ami n'est pas (encore) inscrit sur le site !";
            }
        }

        return $this->render('add/index.html.twig', [
            'search_form' => $findUser->createView(),
            'users' => $user,
            'message' => $message,
        ]);
    }
}
