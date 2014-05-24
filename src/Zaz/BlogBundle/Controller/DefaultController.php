<?php

namespace Zaz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Zaz\BlogBundle\Utility\UserUtility;
use \Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        UserUtility::setRegistry($this->getDoctrine());
        /** @var $user User */
        $user = UserUtility::getUser(array('salt' => $request->getSession()->get('user_tok')));
        return $this->render('ZazBlogBundle:Default:index.html.twig', array(
            'user' => $user
        ));
    }

}
