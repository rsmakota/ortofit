<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\ObjectManager;

use Ortofit\Bundle\SingUpBundle\Entity\Country;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class CountryManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class CountryManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Country::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'country_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $entity = new Country();
        $entity->setName($params->get('name'));
        $entity->setIso2($params->get('iso2'));
        $entity->setPattern($params->get('pattern'));
        $entity->setPrefix($params->get('prefix'));
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
        $entity->setIso2($params->get('iso2'));
        $entity->setPattern($params->get('pattern'));
        $entity->setPrefix($params->get('prefix'));
        $this->merge($entity);
    }
}