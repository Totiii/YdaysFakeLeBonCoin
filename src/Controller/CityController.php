<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @Route("/city", name="city")
     */
    public function index()
    {
        return $this->render('city/index.html.twig', [
            'controller_name' => 'CityController',
        ]);
    }
}
