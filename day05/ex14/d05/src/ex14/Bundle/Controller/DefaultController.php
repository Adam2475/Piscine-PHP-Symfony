<?php

namespace ex14\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;  // annotation import
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method; // method constraint import


// injection test: 
//   '); DROP TABLE vulnerable_form; --
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
        $conn = new \mysqli("127.0.0.1", "adapassa", "symfony123", "symfony_ex11");

         $status = '';
        $rows = [];

        // Use correct MySQL syntax
        $createTableSql = "
            CREATE TABLE IF NOT EXISTS vulnerable_form (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
            )
        ";

        // Execute table creation and capture error if any
        if (!$conn->query($createTableSql)) {
            $status .= "Error creating table: " . $conn->error;
        } else {
            $status .= "Table created or already exists.";
        }

        $result = $conn->query("SELECT * FROM vulnerable_form");

        $rows = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        } else {
            $rows = [];
            $status .= " (Query error: " . $conn->error . ")";
        }

        return $this->render('ex14Bundle:Default:index.html.twig', [
            'status' => $status,
            'rows' => $rows,
        ]);
    }

    /**
     * @Route("/ex14/submit", name="ex14_submit")
     * @Method("POST")
     */
    public function submitAction(Request $request)
    {
        $conn = $this->get('database_connection');
        $name = $request->request->get('name');

        // Vulnerable: direct insertion without escaping or prepared statements
        $sql = "INSERT INTO vulnerable_form (name) VALUES ('$name')";

        try {
            $conn->exec($sql);
        } catch (\Exception $e) {
            return new Response('Error: ' . $e->getMessage());
        }

        return $this->redirect($this->generateUrl('ex14_home'));
    }
}
