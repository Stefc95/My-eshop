<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * Une fonction de controller s'appelle une action, pour rappel name="nomdu controller_nomdel'action"
     * 
     * @Route ("/", name="default_home", methods={"GET"})
     */
   public function home(): Response
   {
    return $this->render('default/home.html.twig');
   }
}
