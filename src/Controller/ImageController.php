<?php

namespace App\Controller;

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
     * @Route("/addImages", name="addImages")
     * @param Request $request
     * @return Response
     */
    public function addImages(Request $request){
        $picture = new Picture();
        $form = $this->createForm(ImageType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($picture);
            $em->flush();
        }

        return $this->render('addImages.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
