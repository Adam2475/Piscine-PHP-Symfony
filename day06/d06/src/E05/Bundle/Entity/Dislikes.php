<?php

namespace E05\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dislikes
 *
 * @ORM\Table(name="dislikes")
 * @ORM\Entity(repositoryClass="E05\Bundle\Repository\DislikesRepository")
 */
class Dislikes
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
     * @ORM\ManyToOne(targetEntity="E01\Bundle\Entity\User")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="E03\Bundle\Entity\Post", inversedBy="dislikes")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $post;

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
     * Set user
     *
     * @param \E01\Bundle\Entity\User $user
     *
     * @return Dislikes
     */
    public function setUser(\E01\Bundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \E01\Bundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post
     *
     * @param \E03\Bundle\Entity\Post $post
     *
     * @return Dislikes
     */
    public function setPost(\E03\Bundle\Entity\Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \E03\Bundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
