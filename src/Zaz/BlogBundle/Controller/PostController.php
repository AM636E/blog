<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 8:16 PM
 */

namespace Zaz\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Debug\Exception\ContextErrorException;
use Symfony\Component\HttpFoundation\Request;
use Zaz\BlogBundle\Entity\Post;
use Zaz\BlogBundle\Entity\User;

class PostController extends Controller
{

    public function createAction (Request $request)
    {
        $post = new Post();

        $form = $this->createFormBuilder($post)
                     ->add('title', 'text')
                     ->add('content', 'textarea')
                     ->add('save', 'submit')
                     ->getForm();

        $form->handleRequest($request);
        $status = "";
        if ( $form->isValid() ) {
            $status = "Success";
            try {
                /** @var $user User */
                $user = $this->container->get('security.context')
                                        ->getToken()
                                        ->getUser();
                $post->setUser($user);
                $post->setUid($user->getId());
                $post->setCreated(time());
                $em = $this->getDoctrine()
                           ->getManager();
                $em->persist($post);
                $em->flush();

            }
            catch (ContextErrorException $e) {
                $status = "Failed to create post. <pre>" . print_r($e) . "</pre>";
            }
        }


        return $this->render('ZazBlogBundle:Post:create.html.twig', array (
            'form'   => $form->createView(),
            'status' => $status
        ));

    }
} 