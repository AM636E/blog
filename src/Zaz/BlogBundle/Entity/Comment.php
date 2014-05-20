<?php

namespace Zaz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Zaz\BlogBundle\Entity\User
     */
    private $user;

    /**
     * @var \Zaz\BlogBundle\Entity\post
     */
    private $post;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Zaz\BlogBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\Zaz\BlogBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Zaz\BlogBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set post
     *
     * @param \Zaz\BlogBundle\Entity\post $post
     * @return Comment
     */
    public function setPost(\Zaz\BlogBundle\Entity\post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Zaz\BlogBundle\Entity\post 
     */
    public function getPost()
    {
        return $this->post;
    }
}
