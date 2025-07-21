<?php

namespace ex04\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// adding the rout package
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/users", name="ex04_user_list")
     */
    public function listAction()
    {
        $mysqli = new \mysqli('localhost', 'symfony_user', 'symfony123', 'symfony_ex00');

        $result = $mysqli->query("SELECT * FROM users_ex04");

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        return $this->render('ex04Bundle:user:list.html.twig', [
            'users' => $users,
            'message' => null
        ]);
    }
    /**
     * @Route("/delete/{id}", name="ex04_user_delete")
     */
    public function deleteAction($id, Request $request)
    {
        $mysqli = new \mysqli('localhost', 'symfony_user', 'symfony123', 'symfony_ex00');

        // Check if user exists
        $result = $mysqli->query("SELECT * FROM users_ex04 WHERE id = " . (int)$id);
        if ($result->num_rows === 0)
        {
            $this->addFlash('error', 'User not found.');
            return new Response("Error: User not found.");
        }

        // Delete the user
        $delete = $mysqli->query("DELETE FROM users_ex04 WHERE id = " . (int)$id);

        if ($delete)
        {
            $this->addFlash('success', 'User deleted successfully.');
            return $this->redirectToRoute('ex04_user_list', [
                'message' => 'User deleted successfully!'
            ]);
        } else {
            return new Response("Error deleting user.");
        }
    }
}

?>