<?php

/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 8:16 PM
 */

namespace Zaz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zaz\BlogBundle\Entity\Post;
use Zaz\BlogBundle\Entity\User;
use Zaz\BlogBundle\Entity\Comment;
use Zaz\BlogBundle\Form\PostFormType;
use Zaz\BlogBundle\Form\CommentType;
use Zaz\BlogBundle\Utility\PostUtility;
use Zaz\BlogBundle\Utility\UserUtility;

class PostController extends Controller
{

    public function createAction(Request $request)
    {
        UserUtility::setRegistry($this->getDoctrine());
        PostUtility::setRegistry($this->getDoctrine());
        /** @var $user User */
        $user = UserUtility::getUser(array('salt' => $request->getSession()->get('user_tok')));
        $post = new Post();

        $form = $this->createForm(new PostFormType(), $post);

        $form->handleRequest($request);

        $status = "";
        if ($form->isValid()) {
            $status = "Success";
            try {
                /** @var $user User */
                $session = $request->getSession();
                // Check if user is authorized.
                if ($session->has('user_tok')) {
                    $post->setCreated(time());
                    $user = UserUtility::getUser(array(
                        'salt' => $session->get('user_tok')
                        )
                    );
                    $post->setUser($user);

                    PostUtility::insertPost($post);
                }
                else {
                    return new Response('Access denied', 403);
                }

                return $this->redirect('/post/' . $post->getId());
            }
            catch (ContextErrorException $e) {
                $status = "Failed to create post. <pre>" . print_r($e) . "</pre>";
            }
        }


        return $this->render('ZazBlogBundle:Post:create.html.twig', array(
            'form' => $form->createView(),
            'status' => $status,
            'user' => $user,
        ));
    }

    public function showAction($pid, Request $request)
    {
        UserUtility::setRegistry($this->getDoctrine());
        PostUtility::setRegistry($this->getDoctrine());
        /** @var $user User */
        $user     = UserUtility::getUser(array('salt' => $request->getSession()->get('user_tok')));
        $post     = PostUtility::getPostById($pid);
        $comments = $this->getDoctrine()->getRepository('ZazBlogBundle:Comment')->findBy(array(
          'post' => $post,
        ));
        $form     = $this->createForm(new CommentType($pid));


        return $this->render('ZazBlogBundle:Post:post.html.twig', array(
            'post' => $post,
            'user' => $user,
            'comment_form' => $form->createView(),
            'comments' => $comments,
        ));
    }

    public function editAction($pid, Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('user_tok')) {
            return new Response('Access denied', 403);
        }
        UserUtility::setRegistry($this->getDoctrine());
        $user = UserUtility::getUser(array('salt' => $session->get('user_tok')));

        $post = $this->getDoctrine()
          ->getRepository('ZazBlogBundle:Post')
          ->findOneBy(array(
          'id' => $pid
        ));

        if ($user->getId() !== $post->getUser()->getId()) {
            return new Response('Access denied', 403);
        }

        $form = $this->createForm(new PostFormType(), $post);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirect('/post/' . $pid);
        }

        return $this->render('ZazBlogBundle:Post:create.html.twig', array(
            'form' => $form->createView(),
            'status' => '',
            'user' => $user,
        ));
    }

    public function deleteAction($pid, Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('user_tok')) {
            return new Response('Access denied', 403);
        }
        UserUtility::setRegistry($this->getDoctrine());
        /** @var $user User */
        $user     = UserUtility::getUser(array('salt' => $session->get('user_tok')));
        $doctrine = $this->getDoctrine();
        /** @var $post Post */
        $post     = $doctrine
          ->getRepository('ZazBlogBundle:Post')
          ->findOneBy(array(
          'id' => $pid
        ));

        if ($user->getId() !== $post->getUser()->getId()) {
            return new Response('Access denied', 403);
        }
        $em       = $doctrine->getManager();
        $comments = $doctrine->getRepository('ZazBlogBundle:Comment')->findBy(array(
          'post' => $post
        ));

        foreach ($comments as $comment) {
            $em->remove($comment);
        }

        $em->remove($post);
        $em->flush();

        return $this->redirect('/user/show/' . $user->getId());
    }

    public
      function commentAction($pid, Request $request)
    {
        $session = $request->getSession();
        if ($session->has('user_tok')) {
            UserUtility::setRegistry($this->getDoctrine());
            PostUtility::setRegistry($this->getDoctrine());
            /** @var $user User */
            $user    = UserUtility::getUser(array('salt' => $request->getSession()->get('user_tok')));
            $comment = new Comment();
            $content = new Post();
            $form    = $this->createForm(new CommentType($pid), $content);

            $form->handleRequest($request);

            if ($form->isValid()) {
                $post = PostUtility::getPostById($pid);
                $content->setCreated(time());
                $content->setUser($user);
                $comment->setContent($content);
                $comment->setUser($user);
                $comment->setPost($post);

                $em = $this->getDoctrine()->getManager();

                $em->persist($content);
                $em->persist($comment);
                $em->flush();

                return $this->redirect('/post/' . $pid);
            }
        }
        else {
            return new Response('Access Denied', 403);
        }
    }

}
