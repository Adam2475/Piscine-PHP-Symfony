<?php

namespace ex05\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use ex05\Bundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/ex05/users", name="ex05_user_list")
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('ex05Bundle:user:list.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/ex05/delete/{id}", name="ex05_user_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            $this->addFlash('error', 'User not found.');
        } else {
            $em->remove($user);
            $em->flush();
            $this->addFlash('success', 'User deleted successfully.');
        }

        return $this->redirectToRoute('ex05_user_list');
    }
}

?>