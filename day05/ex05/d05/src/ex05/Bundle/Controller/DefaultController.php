<?php

namespace ex05\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/ex05", name="delete_orm")
     */
    public function indexAction()
    {
        return $this->render('ex05Bundle:Default:index.html.twig');
    }
}
