<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author    Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Appointment;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Entity\Office;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AppointmentManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class AppointmentManager extends AbstractManager
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'appointment_manager';
    }

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Appointment::clazz();
    }

    protected function getClient($id)
    {
        $client = $this->enManager->getRepository(Client::clazz())->find($id);
        if ($client) {
            return $client;
        }

        throw new \Exception('Can\'t find Client by id');
    }

    /**
     * @param ParameterBag $params
     *
     * @return Appointment
     */
    public function create($params)
    {
        $entity = new Appointment();
        $entity->setClient($params->get('client'));
        $entity->setDateTime($params->get('dateTime'));
        $entity->setDuration($params->get('duration'));
        $entity->setOffice($params->get('office'));
        $entity->setDescription($params->get('description'));
        $entity->setService($params->get('service'));
        $this->persist($entity);

        return $entity;
    }


    /**
     * @param ParameterBag $params
     *
     * @return boolean
     * @throws \Exception
     */
    public function update($params)
    {
        /** @var Appointment $entity */
        $entity = $this->rGet($params->get('id'));
        $entity->setDateTime($params->get('dateTime'));
        $entity->setClient($params->get('client'));
        if ($params->has('state')) {
            $entity->setState($params->get('state'));
        }
        $entity->setDuration($params->get('duration'));
        $entity->setDescription($params->get('description'));
        $entity->setService($params->get('service'));
        $this->merge($entity);

        return true;
    }

    /**
     * @param ParameterBag $bag
     *
     * @return Appointment[]
     */
    public function findByRange(ParameterBag $bag)
    {
        $office = $this->enManager->getRepository(Office::clazz())->find($bag->get('office_id'));

        return $this->enManager->getRepository($this->getEntityClassName())->findByRange(
            $bag->get('from'),
            $bag->get('to'),
            $office
        );
    }
}