<?php

/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 2:29 PM
 */

namespace Zaz\BlogBundle\Controller;

use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zaz\BlogBundle\Entity\User;
use Zaz\BlogBundle\Form\UserLoginType;
use Zaz\BlogBundle\Form\UserRegisterType;
use Zaz\BlogBundle\Utility\Password;
use Zaz\BlogBundle\Utility\UserUtility;

class SecurityController extends Controller
{

    public function loginUser($user)
    {
        
    }

    public function loginAction(Request $request)
    {
        // Check if user logined.
        if ($request->getSession()->has('user_tok')) {
            return $this->redirect($this->generateUrl('zaz_blog_user'));
        }
        UserUtility::setRegistry($this->getDoctrine());

        $user = new User();

        $form = $this->createForm(new UserLoginType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /* @var $dbUser User */
            $dbUser = UserUtility::getUserByUsername($user->getUsername());

            if (!$dbUser) {
                return $this->redirect($this->generateUrl('zaz_blog_register'));
            }
            if (Password::check($user->getPassword(), $dbUser->getSalt(), 10, $dbUser->getPassword())) {
                $session = $request->getSession();
                if (!$session->isStarted()) {
                    $session->start();
                }

                $session->set('user_tok', $dbUser->getSalt());
                $session->save();
            }

            return $this->redirect($this->generateUrl('zaz_blog_user'));
        }

        return $this->render('ZazBlogBundle:Security:login.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function registerAction(Request $request)
    {
        // Check if user authenticated.
        if ($request->getSession()->has('user_tok')) {
            return $this->redirect($this->generateUrl('zaz_blog_user'));
        }
        UserUtility::setRegistry($this->getDoctrine());
        $user = new User();

        $form = $this->createForm(new UserRegisterType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if (UserUtility::userExists($user->getUsername())) {
                return $this->render('ZazBlogBundle:Registration:register.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'User with username given is already exists. Choose another username',
                ));
            }
            $userSalt = md5(time().$user->getUsername());
            $user->setSalt($userSalt);
            $user->setPassword(Password::encrypt($user->getPassword(), $user->getSalt()));
            $session  = $request->getSession();
            $session->start();

            try {
                $em->persist($user);
                $em->flush();
                $session->set('user_tok', $user->getSalt());

                return $this->redirect($this->generateUrl('zaz_blog_user'));
            }
            catch (ORMException $ex) {
                // todo: display some errors.
            }
        }

        return $this->render('ZazBlogBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
            'error' => ''
        ));
    }

    /**
     * Handles user requests and decides what to do.
     * If user authenticated - redirect to profile page.
     * Else redirect to login page.
     * 
     * @param Request $request
     * 
     * @return type
     */
    public function userAction(Request $request)
    {
        UserUtility::setRegistry($this->getDoctrine());
        $session = $request->getSession();
        // Check if user is authenticated.
        if ($session->has('user_tok')) {
            // Get user with user token.
            $user = UserUtility::getUser(array('salt' => $session->get('user_tok')));

            return $this->redirect('/user/show/' . $user->getId());
        }
        else {
            return $this->redirect($this->generateUrl('zaz_blog_login'));
        }
    }

    public function profileAction($uid, Request $request)
    {
        $session = $request->getSession();
        if ($session->has('user')) {
            $user = $session->get('user');

            return $this->render('ZazBlogBundle:Profile:profile.html.twig', array(
                'user' => $user
            ));
        }

        return new \Symfony\Component\HttpFoundation\Response($uid);
    }

    public function logoutAction(Request $request)
    {
        $request->getSession()->clear();

        return $this->redirect($this->generateUrl('zaz_blog_login'));
    }

}
