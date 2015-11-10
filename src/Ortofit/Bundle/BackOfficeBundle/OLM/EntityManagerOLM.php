<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\OLM;

use Ortofit\Bundle\BackOfficeBundle\EntityManager\EntityManagerInterface;

/**
 * Class EntityManagerOLM
 *
 * @package Ortofit\Bundle\BackOfficeBundle\OLM
 */
class EntityManagerOLM implements OLMInterface
{
    /**
     * @var EntityManagerInterface[]
     */
    private $managers = [];

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function addManager($entityManager)
    {
        $this->managers[$entityManager->getName()] = $entityManager;
    }

    /**
     * @param $id
     *
     * @return OLMInterface|null
     */
    public function find($id)
    {
        if (array_key_exists($id, $this->managers)) {
            return $this->managers[$id];
        }
    }

    /**
     * @return EntityManagerInterface[]
     */
    public function all()
    {
        return $this->managers;
    }
}