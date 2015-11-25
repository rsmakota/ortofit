<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use Ortofit\Bundle\SingUpBundle\Entity\EntityInterface;

/**
 * Class AbstractManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
abstract class AbstractManager implements EntityManagerInterface
{
    /**
     * @var EntityManager
     */
    protected $enManager;

    /**
     * AbstractManager constructor.
     * @param EntityManager $enManager
     */
    public function __construct(EntityManager $enManager)
    {
        $this->enManager = $enManager;
    }

    /**
     * @return string
     */
    abstract protected function getEntityClassName();

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @param object $entity
     */
    protected function persist($entity)
    {
        $this->enManager->persist($entity);
        $this->enManager->flush();
    }

    /**
     * @param object $entity
     */
    protected function merge($entity)
    {
        $this->enManager->merge($entity);
        $this->enManager->flush();
    }

    /**
     * @param integer $id
     *
     * @return object
     */
    public function get($id)
    {
        return $this->enManager->getRepository($this->getEntityClassName())->find($id);
    }

    /**
     * @param integer $id
     *
     * @return EntityInterface
     * @throws \Exception
     */
    public function rGet($id)
    {
        $entity = $this->get($id);
        if (null != $entity) {
            return $entity;
        }
        throw new \Exception('Can\'t find '.$this->getEntityClassName().' by id = <<'.$id.'>>');
    }
    /**
     * @param array $params
     *
     * @return EntityInterface[]
     */
    public function findBy($params)
    {
        return $this->enManager->getRepository($this->getEntityClassName())->findBy($params);
    }

    /**
     * @param integer $id
     *
     * @return boolean
     */
    public function remove($id)
    {
        $entity = $this->get($id);
        if (!$entity) {
            return false;
        }
        $this->enManager->remove($entity);
        $this->enManager->flush();

        return true;
    }
}