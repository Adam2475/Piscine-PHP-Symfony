<?php

namespace E01\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// including response object
use Symfony\Component\HttpFoundation\Response;

class CheatSheetController extends Controller
{
    private $categories = [
        'controller', 'routing', 'templating', 'doctrine', 'testing',
        'validation', 'forms', 'security', 'cache', 'translations', 'services'
    ];

    /**
     * @Route("/e01", name="cheatsheet_home")
     */

    public function indexAction()
    {
        // passing categories as a second argument of render
        return $this->render('E01Bundle:CheatSheet:index.html.twig', [
            'categories' => $this->categories
        ]);
    }

    // defining a variable route for subpages

    /**
     * @Route("/e01/{category}", name="cheatsheet_category")
     */

    public function categoryAction($category)
    {
        if (!in_array($category, $this->categories))
        {
            return $this->redirectToRoute("cheatsheet_home");
        }
        return $this->render("E01Bundle:CheatSheet:$category.html.twig");
    }
}
