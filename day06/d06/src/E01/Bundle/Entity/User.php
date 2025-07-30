<?php

namespace E01\Bundle\Entity;

// importing security interface
use Symfony\Component\Security\Core\User\UserInterface;
use E03\Bundle\Entity\Post;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="E01\Bundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @var integer
     * 
     * @ORM\Column(name="reputation", type="integer") 
     */
    private $reputation;

    /**
     *@ORM\OneToMany(targetEntity="E03\Bundle\Entity\Post", mappedBy="author", cascade={"persist", "remove"})
     */
    private $posts;

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
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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

    // public function getRoles()
    // {
    //     return $this->roles;
    // }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function addRole($role)
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = strtoupper($role);
        }
    }

    // public function getRoles()
    // {
    //     return ['ROLE_USER']; // or any roles you assign
    // }
    public function getRoles()
    {
        return $this->roles ?: ['ROLE_USER'];
    }

    public function getSalt()
    {
        return null; // bcrypt/sodium don't need salt
    }

    public function eraseCredentials()
    {
        // If you store any temporary sensitive data, clear it here
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set reputation
     *
     * @param integer $reputation
     *
     * @return User
     */
    public function setReputation($reputation)
    {
        $this->reputation = $reputation;

        return $this;
    }

    /**
     * Get reputation
     *
     * @return integer
     */
    public function getReputation()
    {
        return $this->reputation;
    }

    /**
     * Add post
     *
     * @param \E03\Bundle\Entity\Post $post
     *
     * @return User
     */
    public function addPost(\E03\Bundle\Entity\Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \E03\Bundle\Entity\Post $post
     */
    public function removePost(\E03\Bundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
