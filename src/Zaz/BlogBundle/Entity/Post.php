<?php

namespace Zaz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{

    /**
     * @var integer
     */
    private $basepid;

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
    private $pid;

    /**
     * @var \Zaz\BlogBundle\Entity\User
     */
    private $user;


    /**
     * Set basepid
     *
     * @param integer $basepid
     *
     * @return Post
     */
    public function setBasepid ($basepid)
    {
        $this->basepid = $basepid;

        return $this;
    }

    /**
     * Get basepid
     *
     * @return integer
     */
    public function getBasepid ()
    {
        return $this->basepid;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle ($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle ()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent ($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent ()
    {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return Post
     */
    public function setCreated ($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated ()
    {
        return $this->created;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid ()
    {
        return $this->pid;
    }

    /**
     * Set uid
     *
     * @param \Zaz\BlogBundle\Entity\User $uid
     *
     * @return Post
     */
    public function setUid (\Zaz\BlogBundle\Entity\User $uid = null)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return \Zaz\BlogBundle\Entity\User
     */
    public function getUid ()
    {
        return $this->uid;
    }

    /**
     * @return \Zaz\BlogBundle\Entity\User
     */
    public function getUser ()
    {
        return $this->user;
    }

    /**
     * @param \Zaz\BlogBundle\Entity\User $user
     */
    public function setUser ($user)
    {
        $this->user = $user;
    }
}
