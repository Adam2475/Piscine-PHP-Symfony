<?php

namespace ex12\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $birthdateFilter = $request->query->get('birthdate') ? new \DateTime($request->query->get('birthdate')) : null;
        $sortOrder = strtoupper($request->query->get('sortOrder', 'ASC'));
        $sortField = $request->query->get('sortField', 'name');

        $allowedFields = ['name', 'birthdate'];
        if (!in_array($sortField, $allowedFields)) {
            $sortField = 'name';
        }

        $allowedOrders = ['ASC', 'DESC'];
        if (!in_array($sortOrder, $allowedOrders)) {
            $sortOrder = 'ASC';
        }

        $persons = $this->getDoctrine()
            ->getRepository('ex12Bundle:persons')
            ->findWithRelationsAndFilter($birthdateFilter, $sortField, $sortOrder);

        return $this->render('ex12Bundle:Default:index.html.twig', [
            'persons' => $persons,
            'birthdateFilter' => $birthdateFilter ? $birthdateFilter->format('Y-m-d') : '',
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
        ]);
    }
}
