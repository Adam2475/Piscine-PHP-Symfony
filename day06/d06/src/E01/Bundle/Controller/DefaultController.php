<?php

namespace E01\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// importing user entity
use E01\Bundle\Entity\User;
use E03\Bundle\Entity\Post;
// importing services
use E01\Bundle\Services\RegisterService;

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

        $posts = $this->getDoctrine()
              ->getRepository(Post::class)
              ->findBy([], ['created' => 'DESC']);

        return $this->render('E01Bundle:Default:index.html.twig', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
}
