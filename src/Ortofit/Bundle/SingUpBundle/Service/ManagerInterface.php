<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
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