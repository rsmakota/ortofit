<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Event;

use Ortofit\Bundle\SingUpBundle\Entity\Order;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class OrderCreateEvent
 *
 * @package Ortofit\Bundle\SingUpBundle\Event
 */
class OrderCreateEvent extends Event
{
    /**
     * @var Order
     */
    private $order;

    /**
     * ApplicationSaved constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }


}