<?php

namespace Zaz\BlogBundle\Form;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
/**
 * Description of CommentType
 *
 * @author zaz
 */
class CommentType extends AbstractType
{

    private $pid;

    public function __construct($pid)
    {
        $this->pid = $pid;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $postBuilder = new PostFormType();
        $postBuilder->buildForm($builder, $options);
        $builder->setAction('/post/' . $this->pid . '/comment');
    }

    public function getName()
    {
        return 'comment_type';
    }

}
