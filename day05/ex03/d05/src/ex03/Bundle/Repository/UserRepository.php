<?php

namespace ex03\Bundle\Repository;

use Doctrine\ORM\EntityRepository;
use ex03\Bundle\Entity\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function safeInsert(User $user)
    {
        $em = $this->getEntityManager();

        // Check if username or email already exists
        if ($this->findOneBy(['username' => $user->getUsername()])) {
            return; // Skip insert
        }

        if ($this->findOneBy(['email' => $user->getEmail()])) {
            return; // Skip insert
        }

        $em->persist($user);
        $em->flush();
    }
}
