<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Listener;

use Ortofit\Bundle\SingUpBundle\Event\OrderCreateEvent;
use Ortofit\Bundle\SingUpBundle\Notify\NotifyManagerInterface;

/**
 * Class OrderListener
 *
 * @package Ortofit\Bundle\SingUpBundle\Listener
 */
class OrderListener
{
    /**
     * @var NotifyManagerInterface
     */
    private $notifyManager;

    /**
     * OrderListener constructor.
     * @param NotifyManagerInterface $notifyManager
     */
    public function __construct(NotifyManagerInterface $notifyManager)
    {
        $this->notifyManager = $notifyManager;
    }

    /**
     * @param OrderCreateEvent $event
     */
    public function onCreate(OrderCreateEvent $event)
    {
        $order       = $event->getOrder();
        $msisdn      = $order->getClient()->getMsisdn();
        $application = $order->getApplication();
        $body        = sprintf($application->getNotifyBody(), $msisdn);
        $this->notifyManager->send($application->getNotifySubject(), $body);
    }
}