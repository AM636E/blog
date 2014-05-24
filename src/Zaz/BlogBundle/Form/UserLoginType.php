<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/20/14
 * Time: 10:48 AM
 */
namespace Zaz\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class UserLoginType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('username')->add('password', 'password')->add('save', 'submit');
  }

  /**
   * Returns the name of this type.
   *
   * @return string The name of this type
   */
  public function getName()
  {
    return 'user';
  }
}