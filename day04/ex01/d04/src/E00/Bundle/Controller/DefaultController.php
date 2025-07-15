<?php

namespace E00\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// importing response
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/e00/firstpage", name="first_page")
     */
    public function indexAction()
    {
        return new Response('hello from e00');
    }
}
