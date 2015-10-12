<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;


/**
 * Interface ManagerInterface
 *
 * @package Ortofit\Bundle\SingUpBundle\Service
 */
interface ManagerInterface
{
    /**
     * @param ParameterBag $bag
     *
     * @return object
     */
    public function create($bag);
}