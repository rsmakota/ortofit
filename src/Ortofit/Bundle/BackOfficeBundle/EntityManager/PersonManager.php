<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Person;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class PersonManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class PersonManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Person::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'person_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $status = $this->rGet($params->get('familyStatusId'));
        $entity = new Person();
        $entity->setName($params->get('name'));
        $entity->setAge($params->get('age'));
        $entity->setFamilyStatus($status);
        $this->persist($entity);
    }

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params)
    {
        $status = $this->rGet($params->get('familyStatusId'));
        $entity = $this->rGet($params->get('id'));
        $entity->setName($params->get('name'));
        $entity->setAge($params->get('age'));
        $entity->setFamilyStatus($status);
        $this->merge($entity);
    }
}