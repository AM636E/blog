<?php

namespace Zaz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
<<<<<<< HEAD

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
=======
>>>>>>> post_create
}
