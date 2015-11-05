<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\ObjectManager;


use Ortofit\Bundle\SingUpBundle\Entity\ClientSource;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ClientSourceManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class ClientSourceManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        ClientSource::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'client_source_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $entity = new ClientSource();
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
        /** @var ClientSource $entity */
        $entity = $this->requiredFind($params->get('id'));
        $entity->setName($params->get('name'));
        $this->merge($entity);
    }
}