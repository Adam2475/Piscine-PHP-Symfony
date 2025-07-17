<?php

namespace ex00\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/ex00", name="sql_symfony")
     */
    public function indexAction()
    {
        return $this->render('ex00Bundle:Default:index.html.twig');
    }
}
