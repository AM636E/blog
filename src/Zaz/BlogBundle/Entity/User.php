<?php

namespace Zaz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FOSUser;

/**
 * User
 */
class User extends FOSUser
{

    public function __construct ()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @var integer
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }
}
