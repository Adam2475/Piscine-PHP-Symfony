<?php

namespace ex07\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use src\ex07\Bundle\UserController;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */

    public function indexAction()
    {
        return $this->redirectToRoute('orm_update');
    }
}
