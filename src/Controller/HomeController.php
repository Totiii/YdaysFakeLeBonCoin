<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Repository\AnnouncementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('home.html.twig', [
        ]);
    }

    public function navBar(){
        return $this->render('header.html.twig', [
        ]);
    }

    /**
     * @Route("/home", name="home")
     * @return Response
     */
    public function Announcements(AnnouncementRepository $announcementRepository ) {

        return $this->render('home.html.twig', [
            'announcements' => $announcementRepository->findAll()
        ]);


    }


}
