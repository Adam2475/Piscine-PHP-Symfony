<?php

namespace ex00\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/ex00", name="sql_symfony")
     */
    public function indexAction()
    {
        $message = null;
        $host = 'localhost';
        $user = 'symfony_user';
        $password = 'symfony123';
        $database = 'symfony_ex00';

        $mysqli = new \mysqli($host, $user, $password, $database);

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            enable BOOLEAN NOT NULL,
            birthdate DATETIME NOT NULL,
            address LONGTEXT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        if (isset($_GET['create']))
        {
            try {
                $mysqli->query($sql);
                $message = "Table 'users' created or already exists.";
            } catch (\Exception $e) {
                $message = "Error creating table: " . $e->getMessage();
            }
        }
        
        return $this->render('ex00Bundle:Default:index.html.twig', [
            'message' => $message
        ]);
    }
}
