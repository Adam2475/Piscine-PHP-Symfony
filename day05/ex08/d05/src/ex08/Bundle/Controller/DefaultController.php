<?php

namespace ex08\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// including request and response
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

// including service
use ex08\Bundle\Service\TableService;

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
        $connection = $this->connectDb();
        if (!$connection)
        {
            return Response("error while connecting to db");
        }
        else
        {
            echo "successfully connected";
        }
        // var_dump($connection);
        return $this->render('ex08Bundle:Default:index.html.twig');
    }

    public function connectDb()
    {
        $host = '127.0.0.1';
        $db_name = "symfony_ex00";
        $db_user = "symfony_user";
        $db_password = "symfony123";

        $connection = new \mysqli($host, $db_user, $db_password, $db_name);
        return ($connection);
    }

    /**
     * @Route("/create", name="create_table")
     */
    public function TableAction()
    {
        $connection = $this->connectDb();
        $tableService = $this->get('ex08.TableService');
        $int = $tableService->CreateTable($connection);

        if ($int)
            $this->addFlash('failure', "persons table not created");
        else
            $this->addFlash('success', "persons table created");

        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/update", name="update_table")
     */
    public function UpdateTable()
    {
        $connection = $this->connectDb();
        $tableService = $this->get('ex08.TableService');
        $int = $tableService->UpdateTable($connection);

        if ($int)
            $this->addFlash('failure', "failed to update table");
        else
            $this->addFlash('success', "persons table updated");


        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/tables", name="tables")
     */
    public function NewTables()
    {
        $connection = $this->connectDb();
        $tableService = $this->get('ex08.TableService');
        $int = $tableService->CreateMoreTables($connection);

        if ($int)
            $this->addFlash('failure', "failed to create addresses");
        else
            $this->addFlash('success', "addresses and bank accounts created");

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/relation", name="relations")
     */
    public function AddRelations()
    {
        $connection = $this->connectDb();
        $service = $this->get('ex08.TableService');

        $success = $service->CreateRelationships($connection);

        if ($success === 0) {
            $this->addFlash('success', 'Relationships added successfully.');
        } else {
            $this->addFlash('danger', 'Failed to add relationships.');
        }

        return $this->redirectToRoute('homepage'); 
    }

    /**
     * @Route("/delete", name="delete")
     */
    public function DropTables()
    {
        $connection = $this->connectDb();
        $service = $this->get('ex08.TableService');

        $success = $service->DeleteTables($connection);

        if ($success === 0) {
            $this->addFlash('success', 'tables destroyed.');
        } else {
            $this->addFlash('danger', 'failed to drop tables.');
        }

        return $this->redirectToRoute('homepage');
    }
}
