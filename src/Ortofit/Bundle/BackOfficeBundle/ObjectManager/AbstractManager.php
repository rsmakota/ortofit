<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\ObjectManager;
use Doctrine\ORM\EntityManager;
use Ortofit\Bundle\SingUpBundle\Entity\Appointment;

/**
 * Class AbstractManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
abstract class AbstractManager implements ObjectManagerInterface
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
    public function find($id)
    {
        return $this->enManager->getRepository($this->getEntityClassName())->find($id);
    }

    /**
     * @param integer $id
     *
     * @return object
     * @throws \Exception
     */
    public function requiredFind($id)
    {
        $entity = $this->find($id);
        if (null != $entity) {
            return $entity;
        }
        throw new \Exception('Can\'t find '.$this->getEntityClassName().' by id = <<'.$id.'>>');
    }
    /**
     * @param array $params
     *
     * @return array
     */
    public function findByCriteria($params)
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
        $entity = $this->find($id);
        if (!$entity) {
            return false;
        }
        $this->enManager->remove($entity);
        $this->enManager->flush();

        return true;
    }
}