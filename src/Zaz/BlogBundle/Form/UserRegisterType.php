<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/20/14
 * Time: 11:09 AM
 */

namespace Zaz\BlogBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class UserRegisterType extends UserLoginType
{

  public function buildForm(FormBuilderInterface $formBuilderInterface, array $options)
  {
    $formBuilderInterface->add('email', 'email');
    parent::buildForm($formBuilderInterface, $options);
  }

  /**
   * Returns the name of this type.
   *
   * @return string The name of this type
   */
  public function getName()
  {
    return 'user_register';
  }
}