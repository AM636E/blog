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
     * @var \Zaz\BlogBundle\Entity\Post
     */
    private $post;

    /**
     * @var \Zaz\BlogBundle\Entity\Post
     */
    private $content;


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
     * @param \Zaz\BlogBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\Zaz\BlogBundle\Entity\Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Zaz\BlogBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set content
     *
     * @param \Zaz\BlogBundle\Entity\Post $content
     * @return Comment
     */
    public function setContent(\Zaz\BlogBundle\Entity\Post $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return \Zaz\BlogBundle\Entity\Post 
     */
    public function getContent()
    {
        return $this->content;
    }
}
