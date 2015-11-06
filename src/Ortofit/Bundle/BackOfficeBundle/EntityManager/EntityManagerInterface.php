<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface ManageServiceInterface
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ManageService
 */
interface EntityManagerInterface
{
    /**
     * @return mixed
     */
    public function getName();
    /**
     * @param integer $id
     *
     * @return EntityInterface|null
     */
    public function get($id);

    /**
     * @param integer $id
     *
     * @return EntityInterface
     * @throws \Exception
     */
    public function rGet($id);
    /**
     * @param array $params
     *
     * @return EntityInterface[]
     */
    public function findBy($params);


    /**
     * @param ParameterBag $params
     *
     * @return EntityInterface
     * @throws \Exception
     */
    public function create($params);

    /**
     * @param integer $id
     *
     * @return boolean
     * @throws \Exception
     */
    public function remove($id);

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     * @throws \Exception
     */
    public function update($params);
}