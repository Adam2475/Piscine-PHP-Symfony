<?php

namespace ex11\Bundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $host = '127.0.0.1';
        $user = "adapassa";
        $password = "symfony123";
        $database = "symfony_ex11";
        $connection = new \mysqli($host, $user, $password, $database);

        // get the filter or sort request from the form

        $sortableOrders = ['ASC', 'DESC'];

        $sortOrder = $request->query->get('sort_order', 'ASC');
        $filterDate = $request->query->get('filter_date');

        // Validate date format (Y-m-d)
        $dateObject = \DateTime::createFromFormat('Y-m-d', $filterDate);
        if (!$dateObject || $dateObject->format('Y-m-d') !== $filterDate) {
            $filterDate = null; // Ignore if invalid format
        }

        // Base query with LEFT JOIN
        $sql = "
            SELECT 
            persons.name, 
            persons.surname, 
            persons.birthdate, 
            persons.maritalStatus, 
            persons.enable, 
            addresses.address
            FROM persons
            LEFT JOIN addresses 
            ON persons.id = addresses.persons_id
        ";

        $params = [];
        $types = '';
        if ($filterDate) {
            $sql .= " WHERE persons.birthdate < ?";
            $params[] = $filterDate;
            $types = 's';
        }

        $sql .= " ORDER BY persons.name $sortOrder";

        $stmt = $connection->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $persons = $result->fetch_all(MYSQLI_ASSOC);
        
        return $this->render('ex11Bundle:Default:index.html.twig', [
            'persons' => $persons,
            'current_sort_order' => $sortOrder,
            'current_filter_date' => $filterDate,
        ]);
    }
}
