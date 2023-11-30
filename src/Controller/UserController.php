<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Alias;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user_index')]
    public function request(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        return $this->render('user.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/user/add', name: 'add_user')]
    public function createUser(EntityManagerInterface $entityManager, Request $request) {
        $firstname = $request->get("firstname");
        $lastname = $request->get("lastname");
        $address = $request->get("address");

        $user = new User();
        $user->setData($firstname." - ".$lastname." - ".$address);
        
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('user_index');
    }

    #[Route('/user/{id}/delete', name: 'delete_user')]
    public function delete(EntityManagerInterface $entityManager, int $id) {
        $user = $entityManager->getRepository(User::class)->find($id);

        if($user) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}