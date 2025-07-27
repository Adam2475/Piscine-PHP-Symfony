<?php

namespace ex10\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('ex10Bundle:Default:index.html.twig');
    }
    /**
     * @Route("/lista", name="lista")
     */
    public function renderData()
    {
        $em = $this->getDoctrine()->getManager();

        // ORM items
        $ormItems = $em->getRepository('ex10Bundle:orm_item')->findAll();

        // SQL items
        $connection = $em->getConnection();
        $sql = 'SELECT * FROM sql_item';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $sqlItems = $stmt->fetchAll();

        return $this->render('ex10Bundle:Default:list.html.twig', [
            'ormItems' => $ormItems,
            'sqlItems' => $sqlItems,
        ]);
    }
}
