<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/20/14
 * Time: 10:56 AM
 */

namespace Zaz\BlogBundle\Utility;

/**
 * Class Password
 *
 * Handling tasks with passwords( hashing, checking ).
 *
 * @package Zaz\BlogBundle\Utility
 */
class Password
{

  /**
   *  Encrypt password with sha512 algorithm.
   *
   * @param     $rawPassword
   *  raw password.
   * @param     $salt
   *  salt.
   * @param int $count
   *  count of iterations.
   *
   * @return string
   *  encrypted password.
   */
  public static function encrypt($rawPassword, $salt, $count = 10)
  {
    $password = $rawPassword . $salt;

    for ($i = 0; $i < $count; $i++) {
      $password = hash('sha512', $password);
    }

    return $password;
  }

  /**
   * Checks is password matches to given.
   *
   * @param $rawPassword
   *  unencrypted password.
   * @param $salt
   *  salt password was hashed with.
   * @param $count
   *  count of iterations password was hashed with.
   * @param $toCheck
   *  hashed password to check.
   *
   * @return bool
   *  is passwords match.
   */
  public static function check($rawPassword, $salt, $count, $toCheck)
  {
    $hashed = self::encrypt($rawPassword, $salt, $count);

    return $hashed == $toCheck;
  }
} 