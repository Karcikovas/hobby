<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
    * @Route("/", name="home_FE")
    * @Route("/{route}", name="react_pages", requirements={"route"="^(?!api|admin).+"})
    */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}
