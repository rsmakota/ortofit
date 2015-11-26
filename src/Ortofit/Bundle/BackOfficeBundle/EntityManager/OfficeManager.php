<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Entity\Country;
use Ortofit\Bundle\SingUpBundle\Entity\Office;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ClientManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class OfficeManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Office::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'office_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {

        $entity = new Office();
        $entity->setCity($params->get('city'));
        $entity->setName($params->get('name'));
        $this->persist($entity);

        return $entity;
    }

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params)
    {
        /** @var Office $entity */
        $entity = $this->rGet($params->get('id'));
        $entity->setCity($params->get('city'));
        $entity->setName($params->get('name'));
        $this->merge($entity);
    }
}