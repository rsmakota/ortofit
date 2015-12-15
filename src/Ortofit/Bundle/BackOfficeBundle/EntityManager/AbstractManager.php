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
     * @param EntityInterface $entity
     */
    protected function persist($entity)
    {
        $this->enManager->persist($entity);
        $this->enManager->flush();
    }

    /**
     * @param EntityInterface $entity
     */
    protected function merge($entity)
    {
        $this->enManager->merge($entity);
        $this->enManager->flush();
    }

    /**
     * @param integer $id
     *
     * @return EntityInterface
     */
    public function get($id)
    {
        return $this->enManager->getRepository($this->getEntityClassName())->find($id);
    }
    /**
     * @return EntityInterface[]
     */
    public function all()
    {
        return $this->enManager->getRepository($this->getEntityClassName())->findAll();
    }


    /**
     * @return integer
     */
    public function count()
    {
        $builder = $this->enManager->createQueryBuilder();
        return $builder->select('COUNT(a)')
            ->from($this->getEntityClassName(), 'a')
            ->getQuery()
            ->getSingleScalarResult();
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
     * @param array        $params
     * @param array|null   $orderBy
     * @param integer|null $limit
     * @param integer|null $offset
     *
     * @return EntityInterface[]
     */
    public function findBy($params, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->enManager->getRepository($this->getEntityClassName())->findBy($params, $orderBy, $limit, $offset);
    }

    /**
     * @param array      $params
     * @param array|null $orderBy
     *
     * @return EntityInterface
     */
    public function findOneBy($params, array $orderBy = null)
    {
        return $this->enManager->getRepository($this->getEntityClassName())->findOneBy($params, $orderBy);
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