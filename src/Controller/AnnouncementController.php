<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\Category;
use App\Entity\City;
use App\Entity\Picture;
use App\Form\AnnouncementType;
use App\Form\CityType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;



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
            return $this->redirectToRoute('createCity');
        }

        if ($cityForm->isSubmitted() && $cityForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();
        }

        return $this->render('add.html.twig', [
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
}
