<?php

namespace E01\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// importing user entity
use E01\Bundle\Entity\User;

// importing services
use E01\Bundle\Services\RegisterService;

// use E01\Bundle\Controller\UserController;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('E01Bundle:Default:index.html.twig');
    }
}
