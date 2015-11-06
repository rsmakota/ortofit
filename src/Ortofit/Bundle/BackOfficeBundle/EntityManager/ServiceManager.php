<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Service;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ServiceManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class ServiceManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Service::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'service_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $entity = new Service();
        $entity->setName($params->get('name'));
        $this->persist($entity);
    }

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params)
    {
        $entity = $this->rGet($params->get('id'));
        $entity->setName($params->get('name'));
        $this->merge($entity);
    }
}