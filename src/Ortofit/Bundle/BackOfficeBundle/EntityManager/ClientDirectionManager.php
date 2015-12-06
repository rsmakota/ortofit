<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;


use Ortofit\Bundle\SingUpBundle\Entity\ClientDirection;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ClientSourceManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class ClientDirectionManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return ClientDirection::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'clientDirection_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $entity = new ClientDirection();
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
        /** @var ClientDirection $entity */
        $entity = $this->rGet($params->get('id'));
        $entity->setName($params->get('name'));
        $this->merge($entity);
    }
}