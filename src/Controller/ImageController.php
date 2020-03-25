<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\Picture;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/image", name="image")
     */
    public function index()
    {
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }

    /**
     * @Route("/addImages/{id}", name="addImages")
     * @param Request $request
     * @param Announcement $announcement
     * @return Response
     */
    public function addImages(Request $request, Announcement $announcement){
        $picture = new Picture();
        $form = $this->createForm(ImageType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $picture->setAnnouncement($announcement);
            $em = $this->getDoctrine()->getManager();
            $em->persist($picture);
            $em->flush();
            return $this->redirectToRoute('announcement', array('id' => $announcement->getId()));
        }

        return $this->render('image/addImages.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
