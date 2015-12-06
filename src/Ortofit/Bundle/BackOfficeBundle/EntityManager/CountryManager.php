<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Country;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class CountryManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class CountryManager extends AbstractManager
{
    const DEFAULT_COUNTRY_NAME = 'Ukraine';
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
    public function getDefault()
    {
        return $this->enManager->getRepository($this->getEntityClassName())->findOneBy(['name'=>self::DEFAULT_COUNTRY_NAME]);
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
        $entity = $this->rGet($params->get('id'));
        $entity->setName($params->get('name'));
        $entity->setIso2($params->get('iso2'));
        $entity->setPattern($params->get('pattern'));
        $entity->setPrefix($params->get('prefix'));
        $this->merge($entity);
    }
}