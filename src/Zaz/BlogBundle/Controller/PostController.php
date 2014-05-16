<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 8:16 PM
 */

namespace Zaz\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zaz\BlogBundle\Entity\Post;

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

        if ( $form->isValid() ) {
            $user = $this->container->get('security.context')
                                    ->getToken()
                                    ->getUser();
            $post->setCreated(time());
            $post->setUser($user);
            $em = $this->getDoctrine()
                       ->getManager();

            $em->persist($post);
            $em->flush();
        }


        return $this->render('ZazBlogBundle:Post:create.html.twig', array (
            'form' => $form->createView()
        ));

    }
} 