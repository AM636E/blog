<?php

/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 8:10 PM
 */

namespace Zaz\BlogBundle\Controller;

use \Zaz\BlogBundle\Utility\UserUtility;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Zaz\BlogBundle\Entity\User;

class ProfileController extends Controller
{

    public function showAction($uid = null, Request $request)
    {
        UserUtility::setRegistry($this->getDoctrine());
        /** @var $user User */
        $user = UserUtility::getUser(array('salt' => $request->getSession()->get('user_tok')));

        $posts = $this->getDoctrine()->getRepository('ZazBlogBundle:Post')
          ->findBy(array(
          'user' => $user
        ));

        return $this->render('ZazBlogBundle:Profile:profile.html.twig', array(
            'user' => $user,
            'posts' => $posts
        ));
    }

}
