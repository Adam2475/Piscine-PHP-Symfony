<?php

namespace ex12\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * addresses
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity(repositoryClass="ex12\Bundle\Repository\addressesRepository")
 */
class addresses
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
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

   /**
     * Inverse side of the OneToOne relation to Person
     *
     * @ORM\OneToOne(targetEntity="persons", inversedBy="addresses")
     * @ORM\JoinColumn(name="persons_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $persons;


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
     * Set address
     *
     * @param string $address
     *
     * @return addresses
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set personId
     *
     * @param integer $personId
     *
     * @return addresses
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

    /**
     * Set persons
     *
     * @param \ex11\Bundle\Entity\persons $persons
     *
     * @return addresses
     */
    public function setPersons(\ex11\Bundle\Entity\persons $persons = null)
    {
        $this->persons = $persons;

        return $this;
    }

    /**
     * Get persons
     *
     * @return \ex11\Bundle\Entity\persons
     */
    public function getPersons()
    {
        return $this->persons;
    }
}
