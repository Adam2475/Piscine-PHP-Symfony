<?php

namespace ex07\Bundle\Service;

use ex07\Bundle\Entity\User;

// importing schema tools
use Doctrine\ORM\Tools\SchemaTool;

class CreateTableService
{
    public function createTable($entityManager)
    {
        $metadata = $entityManager->getClassMetadata(User::class);
        $schemaTool = new SchemaTool($entityManager);
        $schemaTool->updateSchema([$metadata], true);
    }

    public function addUsers($em)
    {
        $repo = $em->getRepository('ex07Bundle:User');
        for ($i = 1; $i <= 10; $i++)
        {
            $username = "user$i";
            $email = "user$i@example.com";

            // Skip if user already exists
            if ($repo->findOneBy(['username' => $username]) || $userRepo->findOneBy(['email' => $email])) {
                continue;
            }

            $user = new User();
            $user->setUsername($username);
            $user->setName("User $i");
            $user->setEmail($email);
            $user->setEnable($i % 2 === 0);
            $user->setBirthdate(new \DateTime("1990-01-0$i"));
            $user->setAddress("123 Street No. $i");

            $em->persist($user);
        }

        $em->flush();
    }
}


?>