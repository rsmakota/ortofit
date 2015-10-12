<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;


/**
 * Class BaseManager
 *
 * @package Ortofit\Bundle\SingUpBundle\Service
 */
abstract class AbstractManager implements ManagerInterface
{
    const PARAM_NAME_MSISDN       = 'msisdn';
    const PARAM_NAME_COUNTRY      = 'country';
    const PARAM_NAME_APPLICATION  = 'application';
    /**
     * @var EntityManager
     */
    protected $enManager;

    /**
     * @param EntityManager $eManager
     */
    public function __construct(EntityManager $eManager)
    {
        $this->enManager = $eManager;
    }

    /**
     * @param ParameterBag $bag
     *
     * @return object
     */
    abstract public function create($bag);

}