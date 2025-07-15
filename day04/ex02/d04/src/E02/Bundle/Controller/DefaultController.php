<?php

namespace E02\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/e02", name="first_form")
     */
    public function indexAction()
    {
        return $this->render('E02Bundle:Default:index.html.twig');
    }
}
