<?php

namespace ex09\Bundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * persons
 *
 * @ORM\Table(name="persons")
 * @ORM\Entity(repositoryClass="ex09\Bundle\Repository\personsRepository")
 */
class persons
{
    const MARITAL_SINGLE = 'single';
    const MARITAL_MARRIED = 'married';
    const MARITAL_WIDOWER = 'widower';

    public static $maritalStatuses = [
        self::MARITAL_SINGLE,
        self::MARITAL_MARRIED,
        self::MARITAL_WIDOWER,
    ];

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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=100)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="maritalStatus", type="string", length=20, options={"default":"single"})
     * @assert\Choice(choices={"single", "married", "widower"}, message="chose a valid marital status")
     */
    private $maritalStatus = self::MARITAL_SINGLE;

    /**
     * @ORM\OneToOne(targetEntity="bank_accounts", mappedBy="persons", cascade={"persist", "remove"})
     */
    private $bank_accounts;

    /**
     * @ORM\OneToMany(targetEntity="addresses", mappedBy="persons", cascade={"persist", "remove"})
     */
    private $addresses;


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
     * Set username
     *
     * @param string $username
     *
     * @return persons
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return persons
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return persons
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return persons
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return persons
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     *
     * @return persons
     */
    public function setMaritalStatus($status)
    {
        if (!in_array($status, self::$maritalStatuses)) {
            throw new \InvalidArgumentException("Invalid marital status");
        }

        $this->maritalStatus = $status;
        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }
}

