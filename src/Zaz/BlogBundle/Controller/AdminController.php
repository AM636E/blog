<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 2:32 PM
 */

namespace Zaz\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{

    public function indexAction ()
    {
        return $this->render('ZazBlogBundle:Admin:index.html.twig');
    }

} 