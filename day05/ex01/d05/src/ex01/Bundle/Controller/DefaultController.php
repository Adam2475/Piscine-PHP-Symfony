<?php

namespace ex01\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// process library not working
// use Symfony\Component\Process\Process;
// use Symfony\Component\Process\Exception\ProcessFailedException;


use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// using schema tools to update the schema
use Doctrine\ORM\Tools\SchemaTool;
use ex01\Bundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/ex01", name="symfony_orm")
     */
    public function indexAction()
    {
        $message = null;
        if (isset($_GET['create']))
        {
            $entityManager = $this->getDoctrine()->getManager();
            $metadata = $entityManager->getClassMetadata(User::class);

            $schemaTool = new SchemaTool($entityManager);

            try {
                // Don't fail if table already exists
                $schemaTool->updateSchema([$metadata], true);

                $message = "Table 'users' created or already exists.";
            } catch (\Exception $e) {
                $message = "Error creating table: " . $e->getMessage();
            }
                    
        }

        return $this->render('ex01Bundle:Default:index.html.twig', [
            'message' => $message
        ]);
    }
}
