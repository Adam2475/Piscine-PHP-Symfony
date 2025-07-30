<?php

namespace E01\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// importing user entity
use E01\Bundle\Entity\User;
use E03\Bundle\Entity\Post;
// importing services
use E01\Bundle\Services\RegisterService;
use E04\Bundle\Services\SessionService;
use E05\Bundle\Services\ReputationService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $user = null;
        if ($this->get('security.token_storage')->getToken() && $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))  
        {
           $user = $this->getUser(); 
        }

        $sessionService = $this->get('E04.SessionService');
        $lastRequest = $sessionService->getSecondsSinceLastRequest($request, $user);
        $anonymousName = $sessionService->getAnonymousName($request, $lastRequest, $user);
        $reputationService = $this->get('E05.reputationService');
        $reputation = $reputationService->getUserReputation($user);

        $posts = $this->getDoctrine()
              ->getRepository(Post::class)
              ->findBy([], ['created' => 'DESC']);

        return $this->render('E01Bundle:Default:index.html.twig', [
            'user' => $user,
            'posts' => $posts,
            'anonymousName' => $anonymousName,
            'secondsSinceLastRequest' => $lastRequest,
            'reputation' => $reputation,
        ]);
    }
}
