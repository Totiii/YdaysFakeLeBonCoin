<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\City;
use App\Form\AnnouncementType;
use App\Form\CityType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncementController extends AbstractController
{

    /**
     * @Route("/newAnnouncement", name="newAnnouncement")
     * @param Request $request
     * @return Response
     */
    public function newAnnouncement(Request $request){
        $announcement = new Announcement();
        $city = new City();
        $form = $this->createForm(AnnouncementType::class, $announcement);
        $form->handleRequest($request);
        $user = $this->getUser();
        $cityForm = $this->createForm(CityType::class, $city);
        $cityForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $announcement->setUser($user);
            $announcement->setPublishedDate(new \DateTime());
            $em->persist($announcement);
            $em->flush();
            return $this->redirectToRoute('addImages', array('id' => $announcement->getId()));
        }

        if ($cityForm->isSubmitted() && $cityForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();
        }

        return $this->render('announcement/add.html.twig', [
            'form' => $form->createView(),
            'cityForm' => $cityForm->createView()
        ]);
    }

    /**
     * @Route("/announcement/{id}", name="announcement")
     *
     * @param Announcement $announcement
     * @return Response
     */
    public function announcement(Announcement $announcement) {
        return $this->render('announcement/announcement.html.twig', [
            'announcement' => $announcement
        ]);
    }

    /**
     * @Route("/announcement/{id}/edit", name="editAnnouncement")
     *
     * @param Request $request
     * @param Announcement $announcement
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function editAnnouncement(Request $request, Announcement $announcement, EntityManagerInterface $manager){
        $form = $this->createForm(AnnouncementType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('announcement', array('id' => $announcement->getId()));
        }

        return $this->render('announcement/edit.html.twig', [
            'form' => $form->createView(),
            'movie' => $announcement
        ]);
    }

    /**
     * @Route("/announcement/{id}/delete", name="deleteAnnouncement")
     *
     * @param Announcement $announcement
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     */
    public function deleteAnnouncement(Announcement $announcement, EntityManagerInterface $manager){
        foreach($announcement->getPictures() as $picture){
            $manager->remove($picture);
        }
        $manager->remove($announcement);
        $manager->flush();

        return $this->redirectToRoute('home');
    }

}
