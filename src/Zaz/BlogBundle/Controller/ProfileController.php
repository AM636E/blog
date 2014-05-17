<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 8:10 PM
 */

namespace Zaz\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zaz\BlogBundle\Entity\User;

class ProfileController extends Controller
{

    public function showAction ()
    {
        /** @var $user User */
        $user = $this->getUser();

        if ( !is_object($user) || !$user instanceof User ) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $posts = $this->getDoctrine()
                      ->getRepository('ZazBlogBundle:Post')
                      ->findBy(array ('user' => $user));

        return $this->render('ZazBlogBundle:Profile:show.html.twig', array (
            'user'  => $user,
            'posts' => $posts
        ));
    }
} 