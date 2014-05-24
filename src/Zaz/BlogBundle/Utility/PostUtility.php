<?php

/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/23/14
 * Time: 1:43 PM
 */

namespace Zaz\BlogBundle\Utility;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectRepository;

class PostUtility
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
            self::$repository = $registry->getRepository('ZazBlogBundle:Post');
            self::$manager = $registry->getManager();
        }
    }

    public static function getPost(array $options, $returnSingle = false)
    {
        if ($returnSingle) {
            return self::$repository->findOneBy($options);
        }

        return self::$repository->findBy($options);
    }

    public static function getPostById($id)
    {
        return self::getPost(array('id' => $id), true);
    }

    public static function insertPost($post)
    {
        self::$manager->persist($post);
        self::$manager->flush();
    }

}
