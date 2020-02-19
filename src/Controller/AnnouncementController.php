<?php

namespace App\Controller;

use App\Entity\Announcement;
use App\Entity\Category;
use App\Entity\City;
use App\Entity\Picture;
use App\Form\AnnouncementType;
use App\Form\CityType;
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
     * @Route("/announcement", name="announcement")
     */
    public function index()
    {
        return $this->render('announcement/index.html.twig', [
            'controller_name' => 'AnnouncementController',
        ]);
    }

    /**
     * @Route("/newAnnouncement", name="newAnnouncement")
     * @param Request $request
     * @return Response
     */
    /*
    public function addAnnouncement(Request $request)
    {
        if($request->isMethod('post')){
            $category = $request->request->get('category');
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $price = $request->request->get('price');
            $city = $request->request->get('city');
            $postalCode = $request->request->get('postalCode');
            $address = $request->request->get('address');
            $post = $request->request->get("add_announcement");

            if($post) {
                if ($category and $title and $description and $price and $city and $postalCode and $address) {
                    $em = $this->getDoctrine()->getManager();
                    $announcement = new Announcement();
                    $myCategory = $em->getRepository(Category::class)->findOneBy([
                        'id' => $category
                    ]);
                    $myCity = $em->getRepository(City::class)->findOneBy([
                        'name' => $city,
                        'postalCode' => $postalCode
                    ]);
                    if ($myCity == "") {
                        $myCity = new City();
                        $myCity->setName($city);
                        $myCity->setPostalCode($postalCode);
                        $em->persist($myCity);
                    }

                    $announcement->setCategory($myCategory);
                    $announcement->setName($title);
                    $announcement->setDescription($description);
                    $announcement->setPrice($price);
                    $announcement->setCity($myCity);
                    $announcement->setAdress($address);
                    $announcement->setPublishedDate(new \DateTime());
                    $announcement->setUser($this->getUser());
                    $em->persist($announcement);
                    $em->flush();

                    $this->redirectToRoute('addImages');
                }
            }
        }


        $em = $this->getDoctrine();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('add.html.twig', [
            'categories' => $categories,
        ]);
    }*/

    /**
     * @Route("/newAnnouncement", name="newAnnouncement")
     * @param Request $request
     * @return Response
     */
    public function createMovie(Request $request){
        $announcement = new Announcement();
        $form = $this->createForm(AnnouncementType::class, $announcement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $announcement->setPublishedDate(new \DateTime());
            $em->persist($announcement);
            $em->flush();
        }

        return $this->render('add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
