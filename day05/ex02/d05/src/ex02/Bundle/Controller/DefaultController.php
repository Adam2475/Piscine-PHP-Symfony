<?php

namespace ex02\Bundle\Controller;

// importing request & response
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// importing forms
use Symfony\Component\Form\Forms;
// importing form field types
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/ex02", name="symfony_crud")
     */
    public function indexAction(Request $request)
    {
        $host = 'localhost';
        $user = 'symfony_user';
        $password = 'symfony123';
        $database = 'symfony_ex00';

        $mysqli = new \mysqli($host, $user, $password, $database);

        $sql = "CREATE TABLE IF NOT EXISTS users_ex02 (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            enable BOOLEAN NOT NULL,
            birthdate DATETIME NOT NULL,
            address LONGTEXT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        // DB table creation
        try {
            $mysqli->query($sql);
            echo "Table 'users' created or already exists.";
        } catch (\Exception $e) {
            echo "Error creating table: " . $e->getMessage();
        }

        // form creation
        $form = $this->createFormBuilder()
            ->add('username', TextType::class, [
                'label' => 'Username'
            ])
            ->add('name', TextType::class, [
                'label' => 'Name'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('enable', ChoiceType::class, [
                'label' => 'Enable',
                'choices' => [
                    true => 'yes',
                    false => 'no'
                ]
            ])
            ->add('birthdate', DateType::class, [
                'widget' => 'choice', // other options: 'single_text' or 'text'
                'format' => 'yyyy-MM-dd',
                'years' => range(date('Y') - 100, date('Y')), // from 100 years ago to now
            ])
            ->add('address', TextType::class, [
                'label' => 'address'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            try {
                $query = $mysqli->prepare(
                    "INSERT IGNORE INTO users_ex02 
                    (username, name, email, enable, birthdate, address) 
                    VALUES (?, ?, ?, ?, ?, ?)"
                );
                if (!$query) {
                    throw new \Exception("Prepare failed: " . $mysqli->error);
                }
                // Format birthdate to string (Y-m-d) if it's a DateTime object
                $birthdate = $data['birthdate'] instanceof \DateTime
                    ? $data['birthdate']->format('Y-m-d')
                    : $data['birthdate'];
                $query->bind_param(
                    'sssiss',
                    $data['username'],
                    $data['name'],
                    $data['email'],
                    $data['enable'],
                    $birthdate,
                    $data['address']
                );

                $query->execute();
            }
            catch(\Exception $e)
            {
                $message = "Error: " . $e->getMessage();
            }
            // echo "\nform-activated";
        }

        // Fetch all users to display
        $result = $mysqli->query("SELECT * FROM users_ex02 ORDER BY id ASC");

        // passing the database content to html
        $users = [];
        if ($result)
        {
            while ($row = $result->fetch_assoc())
            {
                $users[] = $row;
            }
            $result->free();
        }

        return $this->render('ex02Bundle:Default:index.html.twig', [
            'form' => $form->createView(),
            'users' => $users,
        ]);
    }
}
