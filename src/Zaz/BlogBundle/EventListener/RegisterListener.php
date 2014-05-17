<?php
/**
 * Created by PhpStorm.
 * User: zaz
 * Date: 5/16/14
 * Time: 10:24 PM
 */

namespace Zaz\BlogBundle\EventListener;


use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegisterListener implements EventSubscriberInterface
{

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents ()
    {
        return array (
            FOSUserEvents::REGISTRATION_CONFIRM => 'onRegistrationConfirm',
        );
    }

    public function onRegistrationConfirm (GetResponseUserEvent $e)
    {
        $e->setResponse(new RedirectResponse('/profile'));
    }
}