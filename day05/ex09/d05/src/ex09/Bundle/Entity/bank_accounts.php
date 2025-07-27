<?php

namespace ex09\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bank_accounts
 *
 * @ORM\Table(name="bank_accounts")
 * @ORM\Entity(repositoryClass="ex09\Bundle\Repository\bank_accountsRepository")
 */
class bank_accounts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="account_num", type="string", length=255)
     */
    private $accountNum;

   /**
     * Inverse side of the OneToOne relation to Person
     *
     * @ORM\OneToOne(targetEntity="persons", inversedBy="bank_accounts")
     * @ORM\JoinColumn(name="persons_id", referencedColumnName="id", onDelete="CASCADE")
     */ 
    private $persons;
    // target persons naming mismatch

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set accountNum
     *
     * @param string $accountNum
     *
     * @return bank_accounts
     */
    public function setAccountNum($accountNum)
    {
        $this->accountNum = $accountNum;

        return $this;
    }

    /**
     * Get accountNum
     *
     * @return string
     */
    public function getAccountNum()
    {
        return $this->accountNum;
    }

    /**
     * Set personId
     *
     * @param integer $personId
     *
     * @return bank_accounts
     */
    public function setPersonId($personId)
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * Get personId
     *
     * @return int
     */
    public function getPersonId()
    {
        return $this->personId;
    }
}

