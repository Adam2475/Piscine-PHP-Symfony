<?php

namespace ex04\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// including the service
use ex04\Bundle\Service\CreateTableService;

// including response object
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/ex04", name="sql_delete")
     */
    public function indexAction()
    {
        $myService = $this->get('ex04.create_table_service');
        $mysqli = $myService->createTable();
        $myService->addTestUser($mysqli);
        
        return $this->render('ex04Bundle:Default:index.html.twig');

        // return new Response($message);
    }
}
