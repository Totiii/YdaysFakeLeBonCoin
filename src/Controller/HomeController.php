<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Repository\AnnouncementRepository;
use App\Repository\CategoryRepository;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    public function navBar(){
        return $this->render('header.html.twig', [
        ]);
    }

    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return Response
     */
    public function Announcements(AnnouncementRepository $announcementRepository, CategoryRepository $categoryRepository, CityRepository $cityRepository, Request $request) {

        $announcements = $announcementRepository->findAll();

        if($request->isMethod('get')) {
            $category = $request->query->get('category');
            $city = $request->query->get('city');

            if ($category){
                $announcements = $announcementRepository->findBy(['category' => $category]);
            }else if ($city){
                $announcements = $announcementRepository->findBy(['city' => $city]);
            }
        }

            return $this->render('home.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'cities' => $cityRepository->findAll(),
            'announcements' => $announcements,
        ]);

    }


}
