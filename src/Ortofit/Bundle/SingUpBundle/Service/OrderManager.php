<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Service;

use Ortofit\Bundle\SingUpBundle\Entity\Order;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class ApplicationManager
 *
 * @package Ortofit\Bundle\SingUpBundle\Service
 */
class OrderManager extends AbstractManager
{
    
    /**
     * @param ParameterBag $bag
     *
     * @return Order
     */
    public function create($bag)
    {
        $entity = new Order();
        $entity->setClient($bag->get('client'));
        $entity->setApplication($bag->get('application'));

        $this->enManager->persist($entity);
        $this->enManager->flush();

        return $entity;
    }
}