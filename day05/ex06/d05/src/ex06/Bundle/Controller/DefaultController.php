<?php

namespace ex06\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use \ex07\Bundle\Service\CreateTableService;

// including request & response objects
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/ex06", name="ex06_list")
     */
    public function listAction()
    {
        $service = $this->get('ex06.CreateTableService');
        $service->createTable();
        $conn = $this->get('database_connection');
        $service->addTestUser($conn);
        $users = $conn->fetchAll("SELECT * FROM users_ex06");

        $message = null;
        if (isset($_GET['msg'])) {
            $message = $_GET['msg'];
        }

        return $this->render('ex06Bundle:user:list.html.twig', [
            'users' => $users,
            'message' => $message
        ]);
    }

    /**
     * @Route("/ex06/edit/{id}", name="ex06_edit")
     */
    public function editAction(Request $request, $id)
    {
        $conn = $this->get('database_connection');

        // Fetch user
        $user = $conn->fetchAssoc("SELECT * FROM users_ex06 WHERE id = ?", [$id]);

        if (!$user) {
            return new Response("User not found", 404);
        }

        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $address = $request->request->get('address');

            try {
                $conn->executeUpdate(
                    "UPDATE users_ex06 SET username = ?, name = ?, email = ?, address = ? WHERE id = ?",
                    [$username, $name, $email, $address, $id]
                );
                return $this->redirect($this->generateUrl('ex06_list', ['msg' => 'User updated successfully!']));
            } catch (\Exception $e) {
                return $this->redirect($this->generateUrl('ex06_list', ['msg' => 'Error updating user.']));
            }
        }

        return $this->render('ex06Bundle:user:edit.html.twig', [
            'user' => $user
        ]);
    }
}
