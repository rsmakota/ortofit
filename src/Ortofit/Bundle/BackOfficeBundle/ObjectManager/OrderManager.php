<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\ObjectManager;

use Ortofit\Bundle\SingUpBundle\Entity\Order;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class OrderManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class OrderManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Order::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'order_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $application = $this->requiredFind($params->get('applicationId'));
        $client = $this->requiredFind($params->get('clientId'));
        $entity = new Order();
        $entity->setApplication($application);
        $entity->setClient($client);
        $this->persist($entity);
    }

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params)
    {
        $application = $this->requiredFind($params->get('applicationId'));
        $client = $this->requiredFind($params->get('clientId'));
        $entity = $this->requiredFind($params->get('id'));
        $entity->setApplication($application);
        $entity->setClient($client);
        $this->merge($entity);
    }
}