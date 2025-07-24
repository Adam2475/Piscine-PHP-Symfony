<?php

namespace E01\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// importing user entity
use E01\Bundle\Entity\User;

use E01\Bundle\Services\RegisterService;
use E01\Bundle\Services\LoginService;

// importing request object
use Symfony\Component\HttpFoundation\Request;

// importing security interface
use Symfony\Component\Security\Core\User\UserInterface;

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
            $encoder = $this->get('security.password_encoder');
            $encodedPassword = $encoder->encodePassword($user, $data['password']);
            $user->setPassword($encodedPassword);
            $user->setUsername($data['username']);
            //$user->setPassword($data['password']); // hash before storing!
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
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $loginService = $this->get('E01.LoginService');
        $loginForm = $loginService->createLoginForm();
        $loginForm->handleRequest($request);

        if ($loginForm->isSubmitted() && $loginForm->isValid())
        {
            $data = $loginForm->getData();
            $username = $data['username'];
            $password = $data['password'];

            $user = $this->getDoctrine()
                ->getRepository('E01Bundle:User')
                ->findOneBy(['username' => $username]);

            if (!$user)
            {
                $this->addFlash('error', "user not found");
                return $this->redirectToRoute('login');
            }

            $encoder = $this->get('security.password_encoder');

            if (!$encoder->isPasswordValid($user, $password))
            {
                $this->addFlash('error', 'Invalid creadentials');
                return $this->redirectToRoute('login');
            }

            $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken(
                $user, null, 'main', $user->getRoles()
            );

            $this->get('security.token_storage')->setToken($token);

            // save the token in session
            $this->get('session')->set('_security_main', serialize($token));

            // $this->addFlash('success', 'welcome back' . $user->getUsername());
            return $this->redirectToRoute('homepage');
        }

        return $this->render('E01Bundle:Form:form.html.twig', [
            'form' => $loginForm->createView(),
        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        // This method is intentionally left blank.  Symfony handles the logout logic.
        // The logout path is handled by the firewall configuration.
    }
}

?>