<?php

namespace ex07\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use \ex07\Bundle\Service\CreateTableService;

// importing schema tools
use Doctrine\ORM\Tools\SchemaTool;

// importing User entity
use ex07\Bundle\Entity\User;

// including forms
use Symfony\Component\Form\Forms;

// including request & response objects
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends Controller
{
    /**
     * @Route("/ex07", name="orm_update")
     */
    public function mainProcedure()
    {
        $entityManager = $this->getDoctrine()->getManager();
        // var_dump($entityManager);
        $tableService = $this->get('ex07.CreateTableService');
        $tableService->createTable($entityManager);
        return $this->indexAction($tableService, $entityManager);
    }

    public function indexAction($tableService, $em)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $tableService->addUsers($em);
        return $this->render('ex07Bundle:users:list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/ex07/edit/{id}", name="user_edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            return new Response("User not found", 404);
        }

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('enable', CheckboxType::class, ['required' => false])
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'
            ])
            ->add('address', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Update'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            try {
                $em->flush();
                $this->addFlash('success', 'User updated successfully!');
                return $this->redirectToRoute('orm_update');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error updating user.');
            }
        }

        return $this->render('ex07Bundle:users:edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
