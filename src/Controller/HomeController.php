<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/", name="home_page")
     */
    public function home()
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController'
        ]);
    }
}
