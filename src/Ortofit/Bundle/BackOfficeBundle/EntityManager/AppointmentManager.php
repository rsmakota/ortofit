<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Appointment;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
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
        $client = $this->getClient($params->get('clientId'));
        $office = $this->rGet('officeId');
        $entity = new Appointment();
        $entity->setClient($client);
        $entity->setTime(new \DateTime($params->get('time')));
        $entity->setOffice($office);
        $this->persist($entity);
    }


    /**
     * @param ParameterBag $params
     *
     * @return boolean
     * @throws \Exception
     */
    public function update($params)
    {
        $client = $this->getClient($params->get('clientId'));
        /** @var Appointment $entity */
        $entity = $this->rGet($params->get('id'));
        $entity->setTime(new \DateTime($params->get('time')));
        $entity->setClient($client);
        $entity->setState($params->get('state'));
        $this->merge($entity);

        return true;
    }


}