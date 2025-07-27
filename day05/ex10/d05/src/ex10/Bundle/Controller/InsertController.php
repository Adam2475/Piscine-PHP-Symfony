<?php

namespace ex10\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use ex10\Bundle\Entity\orm_item;

class InsertController extends Controller
{
    /**
     * @Route("/ex10", name="ex10")
     */
    public function import()
    {
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();

        $filePath = __DIR__ . '/file.txt';

        if (!file_exists($filePath)) {
            return new Response("File not found");
        }

        $handle = fopen($filePath, 'r');
        if (!$handle) {
            return new Response("Cannot open file");
        }

        while (($line = fgets($handle)) !== false) {
            $data = explode(',', trim($line));
            if (count($data) < 2) continue;

            $name = $data[0];
            $desc = $data[1];

            // Insert with SQL
            $sql = "INSERT IGNORE INTO sql_item (name, unction) VALUES (:name, :desc)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'desc' => $desc
            ]);

            $existingItem = $em->getRepository('ex10Bundle:orm_item')->findOneBy(['name' => $name]);
            
            if (!$existingItem)
            {
                // Insert with ORM
                $item = new orm_item();
                $item->setName($name);
                $item->setFunction($desc);
                // $item->setCreatedAt($now);
                $em->persist($item);
            }
        }

        fclose($handle);

        $em->flush();

        return $this->redirectToRoute('lista');
    }
}


?>