<?php

namespace ex13\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="ex13\Bundle\Repository\EmployeeRepository")
 */
class Employee
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="employed_since", type="datetime")
     */
    private $employedSince;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="employed_until", type="datetime", nullable=true)
     */
    private $employedUntil;

    /**
     * @var string
     *
     * @ORM\Column(name="hours", type="string", length=2)
     * @assert\Choice(choices={"4","6","8"}, message="select valid number of working hours")
     */
    private $hours;

    /**
     * @var int
     *
     * @ORM\Column(name="salary", type="integer")
     */
    private $salary;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=20)
     * @assert\Choice(choices={"manager", "account_manager", "qa_manager", "dev_manager", "ceo", "coo", "backend_dev", "frontend_dev", "qa_tester"}, message="select a valid role")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumn(name="manager_id", referencedColumnName="id", nullable=true)
     */
    private $manager;


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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Employee
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Employee
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Employee
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
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Employee
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Employee
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set employedSince
     *
     * @param \DateTime $employedSince
     *
     * @return Employee
     */
    public function setEmployedSince($employedSince)
    {
        $this->employedSince = $employedSince;

        return $this;
    }

    /**
     * Get employedSince
     *
     * @return \DateTime
     */
    public function getEmployedSince()
    {
        return $this->employedSince;
    }

    /**
     * Set employedUntil
     *
     * @param \DateTime $employedUntil
     *
     * @return Employee
     */
    public function setEmployedUntil($employedUntil)
    {
        $this->employedUntil = $employedUntil;

        return $this;
    }

    /**
     * Get employedUntil
     *
     * @return \DateTime
     */
    public function getEmployedUntil()
    {
        return $this->employedUntil;
    }

    /**
     * Set hours
     *
     * @param string $hours
     *
     * @return Employee
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return string
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set salary
     *
     * @param integer $salary
     *
     * @return Employee
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Employee
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set manager
     *
     * @param \ex13\Bundle\Entity\Employee $manager
     *
     * @return Employee
     */
    public function setManager(\ex13\Bundle\Entity\Employee $manager = null)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return \ex13\Bundle\Entity\Employee
     */
    public function getManager()
    {
        return $this->manager;
    }
}
