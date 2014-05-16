<?php

namespace Zaz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
<<<<<<< HEAD
=======
    /**
     * @var string
     */
    private $uid;

>>>>>>> post_create
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var integer
     */
    private $created;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Zaz\BlogBundle\Entity\User
     */
    private $user;


    /**
<<<<<<< HEAD
=======
     * Set uid
     *
     * @param string $uid
     * @return Post
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return string 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
>>>>>>> post_create
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Post
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get id
     *
     * @return integer 
     */
<<<<<<< HEAD
    public function getPid()
=======
    public function getId()
>>>>>>> post_create
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Zaz\BlogBundle\Entity\User $user
     * @return Post
     */
<<<<<<< HEAD
    public function setUser(\Zaz\BlogBundle\Entity\User $user = null)
=======
    public function setUser(\Zaz\BlogBundle\Entity\User $user)
>>>>>>> post_create
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
<<<<<<< HEAD
     * @return \Zaz\BlogBundle\Entity\User
=======
     * @return \Zaz\BlogBundle\Entity\User 
>>>>>>> post_create
     */
    public function getUser()
    {
        return $this->user;
    }
}
