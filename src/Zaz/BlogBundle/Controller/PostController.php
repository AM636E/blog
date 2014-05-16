<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 8:16 PM
 */

namespace Zaz\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zaz\BlogBundle\Entity\Post;

class PostController extends Controller
{

    public function createAction ()
    {
        $post = new Post();

        $form = $this->createFormBuilder($post)
                     ->add('title', 'text')
                     ->add('content', 'textarea')
                     ->add('save', 'submit')
                     ->getForm();


        return $this->render('ZazBlogBundle:Post:create.html.twig', array (
            'form' => $form->createView()
        ));

    }
} 