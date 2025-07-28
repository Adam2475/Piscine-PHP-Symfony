<?php

namespace ex13\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ex13\Bundle\Entity\Employee;
use ex13\Bundle\Form\EmployeeType;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        return $this->render('ex13Bundle:Default:index.html.twig');
    }
    /**
     * @Route("/new", name="new")
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm(new EmployeeType(), $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($employee);
                $em->flush();
                $this->addFlash('success', 'Employee created successfully!');
                return $this->redirectToRoute('employee_list');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Could not save employee: ' . $e->getMessage());
            }
        }

        return $this->render('ex13Bundle:Default:new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/read", name="read")
     */
    public function listAction()
    {
        $employees = $this->getDoctrine()->getRepository('ex13Bundle:Employee')->findAll();

        return $this->render('ex13Bundle:Default:list.html.twig', [
            'employees' => $employees,
        ]);
    }
    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $employee = $em->getRepository('ex13Bundle:Employee')->find($id);

        if (!$employee) {
            throw $this->createNotFoundException('Employee not found.');
        }

        $form = $this->createForm(new EmployeeType(), $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->flush();
                $this->addFlash('success', 'Employee updated successfully!');
                return $this->redirectToRoute('employee_list');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Could not update employee: ' . $e->getMessage());
            }
        }

        return $this->render('ex13Bundle:Employee:edit.html.twig', [
            'form' => $form->createView(),
            'employee' => $employee,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $employee = $em->getRepository('ex13Bundle:Employee')->find($id);

        if (!$employee) {
            $this->addFlash('error', 'Employee not found.');
        } else {
            try {
                $em->remove($employee);
                $em->flush();
                $this->addFlash('success', 'Employee deleted successfully!');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Could not delete employee: ' . $e->getMessage());
            }
        }

        return $this->redirectToRoute('read');
    }
    

}
