<?php

namespace D07\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Ex01Controller extends Controller
{
    /**
     * @Route("/ex01")
     */
    public function indexAction()
    {
        $number = $this->getParameter('d07.number');
        $enable = $this->getParameter('d07.enable');
        echo $number;
        if ($enable)
            echo "enabled";
        else
            echo "not enabled";
        // echo $enable;
        return $this->render('D07Bundle:Default:index.html.twig');
    }
}
