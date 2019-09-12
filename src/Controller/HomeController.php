<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/home/{prenom}/{age}", name="home_page")
     */
    public function home($prenom = 'Anonymous',$age = 0)
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
            'prenom' => $prenom,
            'age' => $age
        ]);
    }
}
