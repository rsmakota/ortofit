<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Service;

use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class ApplicationManager
 *
 * @package Ortofit\Bundle\SingUpBundle\Service
 */
class ApplicationManager extends AbstractManager
{
    /**
     * @param ParameterBag $bag
     *
     * @return Application
     */
    public function create($bag)
    {
        $entity = new Application();
        $entity->setClient($bag->get('client'));
        $entity->setType($bag->get('type'));

        $this->enManager->persist($entity);
        $this->enManager->flush();

        return $entity;
    }
}