<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{
    /**
     * @Route("/announcement", name="announcement")
     */
    public function index()
    {
        return $this->render('announcement/index.html.twig', [
            'controller_name' => 'AnnouncementController',
        ]);
    }

    /**
     *@Route("/newAnnouncement", name="newAnnouncement")
     */
    public function addAnnouncement()
    {
        $em = $this->getDoctrine();
        $repo = $em->getRepository(Category::class)->findAll();

        return $this->render('add.html.twig', [
            'categories' => $repo
        ]);
    }
}
