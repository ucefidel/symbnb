<?php

namespace App\Controller;

use App\Repository\AdRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home_page")
     */
    public function home(AdRepository $repo, UserRepository $userRepo)
    {
        return $this->render('home.html.twig', [
            'ads'   => $repo->findBestAds(3),
            'users' => $userRepo->findBestUsers(2)
        ]);
    }
}
