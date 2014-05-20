<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 8:10 PM
 */

namespace Zaz\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zaz\BlogBundle\Entity\User;

class ProfileController extends BaseController
{

    public function showAction ($uid = null)
    {
        /** @var $user User */
        if ( $uid === null ) {
            $user = $this->container->get('security.context')
                                    ->getToken()
                                    ->getUser();
        }
        else {
            $user = $this->container->get('doctrine')
                                    ->getRepository('ZazBlogBundle:User')
                                    ->findOneBy(array (
                    'id' => $uid
                ));
        }

        if ( !is_object($user) || !$user instanceof User ) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $posts = $this->container->get('doctrine')
                                 ->getRepository('ZazBlogBundle:Post')
                                 ->findBy(array ('user' => $user));

        return $this->container->get('templating')
                               ->renderResponse('ZazBlogBundle:Profile:show.html.twig', array (
                'user'  => $user,
                'posts' => $posts
            ));
    }
}
