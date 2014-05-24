<?php

/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/22/14
 * Time: 9:11 AM
 */

namespace Zaz\BlogBundle\Utility;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectRepository;
use Zaz\BlogBundle\Entity\User;

/**
 * Class UserUtility
 *
 * Handles tasks belong to user.
 *
 * @package Zaz\BlogBundle\Utility
 */
class UserUtility
{

    /**
     * @var ObjectRepository
     */
    private static $repository;

    /**
     * @var Registry
     */
    private static $registry = null;

    /**
     *
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private static $manager;

    public static function setRegistry(Registry $registry)
    {
        if (self::$registry === null) {
            self::$registry = $registry;
            self::$repository = $registry->getRepository('ZazBlogBundle:User');
            self::$manager = $registry->getManager();
        }
    }

    public static function getUserByUsername($username)
    {
        return self::getUser(array('username' => $username));
    }

    /**
     * Get user with criteria from user repository.
     *
     * @param array $criteria
     *
     * @return array|User
     */
    public static function getUser(array $criteria)
    {
        return self::queryUsers($criteria, true);
    }

    /**
     * Get users by criteria.
     *
     * @param array $criteria
     *  criteria to select users.
     * @param bool $returnOne
     *  if this set to true than if array of users contains single object, it will returned.
     *
     * @return array|User
     */
    public static function queryUsers(array $criteria, $returnOne = false)
    {
        if ($returnOne) {
            return self::$repository
                ->findOneBy($criteria);
        }

        return self::$repository
            ->findBy($criteria);
    }

    /**
     * Check if user conforms specified criteria exists in database.
     *
     * @param array|string $criteria
     *  criteria.
     *  if string is given it processed as username.
     *
     * @return bool
     */
    public static function userExists($criteria)
    {
        if (is_string($criteria)) {
            $criteria = array('username' => $criteria);
        }

        return self::getUser($criteria) !== null;
    }

    public static function insertUser($user)
    {
        self::$manager->persist($user);
        self::$manager->flush();
    }

}
