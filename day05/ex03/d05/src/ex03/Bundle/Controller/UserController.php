<?php

namespace ex03\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ex03\Bundle\Entity\User;
use ex03\Bundle\Form\UserType;

class UserController extends Controller
{
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getRepository('ex03Bundle:User')->safeInsert($user);
            return $this->redirectToRoute('ex03_list');
        }

        return $this->render('ex03Bundle:User:new.html.twig', ['form' => $form->createView()]);
    }

    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('ex03Bundle:User')->findAll();
        return $this->render('ex03Bundle:User:list.html.twig', ['users' => $users]);
    }
}

?>
