<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\ObjectManager;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface ManageServiceInterface
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ManageService
 */
interface ObjectManagerInterface
{
    /**
     * @param integer $id
     *
     * @return object
     */
    public function find($id);

    /**
     * @param array $params
     *
     * @return array
     */
    public function findByCriteria($params);

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params);

    /**
     * @param integer $id
     *
     * @return boolean
     */
    public function remove($id);

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params);
}