<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\ObjectManager;

use Ortofit\Bundle\SingUpBundle\Entity\FamilyStatus;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class FamilyStatusManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class FamilyStatusManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return FamilyStatus::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'family_status_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $entity = new FamilyStatus();
        $entity->setName($params->get('name'));
        $entity->setGeneral($params->get('general'));
        $this->persist($entity);
    }

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params)
    {
        $entity = $this->requiredFind($params->get('id'));
        $entity->setName($params->get('name'));
        $entity->setGeneral($params->get('general'));
        $this->merge($entity);
    }
}