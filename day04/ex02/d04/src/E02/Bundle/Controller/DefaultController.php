<?php

namespace E02\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// importing request & response
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// importing forms
use Symfony\Component\Form\Forms;
// importing form field types
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

// including NotBlank validator
use Symfony\Component\Validator\Constraints\NotBlank;

class DefaultController extends Controller
{
    /**
     * @Route("/e02", name="first_form")
     */

    public function demoFormAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('message', TextType::class, [
                'label' => 'Message',
                'constraints' => [
                    new NotBlank([
                        'message' => 'the mesage cannot be blank',
                    ])
                ],
            ])
            ->add('timestamp', ChoiceType::class, [
                'label' => 'Include timestamp',
                'choices' => [
                    'Yes' => 'Yes',
                    'No' => 'No'
                ]
            ])
            ->getForm();

            $form->handleRequest($request);
            $lastLine = null;
            $filePath = $this->getParameter('notes_file');

            if ($form->isSubmitted() && $form->isValid())
            {
                $data = $form->getData();
                // print_r($data);
                $message = trim($data['message']);
                $includeTimestamp = $data['timestamp'];

                // echo $data['timestamp'];

                if ($includeTimestamp == "Yes")
                {
                    $line = $message . ' | ' . date('Y-m-d H:i:s');
                }
                else
                {
                    $line = $message;
                }

                // echo $includeTimestamp;
                // echo $message;

                if (!file_exists($filePath))
                {
                    touch($filePath);
                }

                file_put_contents($filePath, $line . PHP_EOL, FILE_APPEND);

                $lastLine = $line;
            }

            // return the index and form as parameter
            return $this->render('E02Bundle:Default:index.html.twig', [
                'form' => $form->createView(),
                'last_line' => $lastLine,
            ]);
    }

    // public function indexAction()
    // {
    //     // creating form

    //     return $this->render('E02Bundle:Default:index.html.twig');
    // }
}
