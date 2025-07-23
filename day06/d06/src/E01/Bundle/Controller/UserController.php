<?php

namespace E01\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// importing user entity
use E01\Bundle\Entity\User;

use E01\Bundle\Services\RegisterService;

// importing request object
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function Register(Request $request)
    {
        $registerService = $this->get('E01.RegisterService');
        $form = $registerService->createForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $user = new User;
            $user->setUsername($data['username']);
            $user->setPassword($data['password']); // hash before storing!
            $user->setEmail($data['email']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Set a flash message
            $this->addFlash('success', 'User created successfully!');

            return $this->redirectToRoute('homepage');
        }


        return $this->render('E01Bundle:Form:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


?>