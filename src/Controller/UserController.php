<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/user/{id}", name="userProfile")
     *
     * @param User $user
     * @return Response
     */
    public function announcement(User $user) {
        return $this->render('user/profile.html.twig', [
            'user' => $user
        ]);
    }
/*
    /**
     * @Route("/user/{id}/edit", name="editUser")
     *
     * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return Response
     */
    /*
        public function editUser(Request $request, User $user, EntityManagerInterface $manager){
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $manager->flush();

                return $this->redirectToRoute('userProfile');
            }

            return $this->render('user/Edit.html.twig', [
                'form' => $form->createView(),
                'user' => $user
            ]);
        }
        */
}
