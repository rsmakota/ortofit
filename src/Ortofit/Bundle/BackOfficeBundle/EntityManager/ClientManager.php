<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Appointment;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Entity\Country;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class ClientManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class ClientManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Client::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'client_manager';
    }

    /**
     * @param integer $id
     *
     * @return Country
     * @throws \Exception
     */
    private function getCountry($id)
    {
        $country = $this->enManager->getRepository($this->getEntityClassName())->find($id);
        if ($country) {
            return $country;
        }
        throw new \Exception('Can\'t find Country by id');
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $entity = new Client();
        $entity->setCountry($params->get('country'));
        $entity->setClientDirection($params->get('clientDirection'));
        $entity->setMsisdn($params->get('msisdn'));
        $entity->setName($params->get('name'));
        $entity->setGender($params->get('gender'));
        $this->persist($entity);

        return $entity;
    }

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params)
    {
        /** @var Client $entity */
        $entity = $this->rGet($params->get('id'));
        $entity->setCountry($params->get('country'));
        $entity->setClientDirection($params->get('clientDirection'));
        $entity->setMsisdn($params->get('msisdn'));
        $entity->setGender($params->get('gender'));
        $this->merge($entity);
    }
}