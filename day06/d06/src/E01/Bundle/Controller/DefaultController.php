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
        $user = null;
        if ($this->get('security.token_storage')->getToken() && $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))  
        {
           $user = $this->getUser(); 
        }
        
        // var_dump($user);

        return $this->render('E01Bundle:Default:index.html.twig', [
            'user' => $user,
        ]);
    }
}
