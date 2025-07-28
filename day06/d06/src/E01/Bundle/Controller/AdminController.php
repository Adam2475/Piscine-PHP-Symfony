<?php

namespace E01\Bundle\Controller;

use E01\Bundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

// * @Security("has_role('ROLE_ADMIN')")


/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/users", name="admin_user_list")
     */
    public function listUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('E01Bundle:User')->findAll();

        return $this->render('E01Bundle:admin:admin.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/users/delete/{id}", name="admin_delete_user")
     */
    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $userToDelete = $em->getRepository('E01Bundle:User')->find($id);
        $currentUser = $this->getUser();

        if (!$userToDelete) {
            throw $this->createNotFoundException('User not found');
        }

        if ($userToDelete->getId() === $currentUser->getId()) {
            $this->addFlash('error', 'You cannot delete your own account.');
            return $this->redirectToRoute('admin_user_list');
        }

        $em->remove($userToDelete);
        $em->flush();

        $this->addFlash('success', 'User deleted successfully.');
        return $this->redirectToRoute('admin_user_list');
    }
}

?>