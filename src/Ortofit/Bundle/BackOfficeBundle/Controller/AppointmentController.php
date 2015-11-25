<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\AppointmentManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ClientManager;
use Ortofit\Bundle\SingUpBundle\Entity\EntityInterface;
/**
 * Class AppointmentController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class AppointmentController extends Controller
{
    /**
     * @return AppointmentManager
     */
    private function getAppointmentManager()
    {
        return $this->get('ortofit_back_office.appointment_manage');
    }

    /**
     * @return ClientManager
     */
    private function getClientManager()
    {
        return $this->get('ortofit_back_office.client_manage');
    }

    /**
     * @param string $msisdn
     * @param string $name
     *
     * @return EntityInterface[]
     */
    private function getClient($msisdn, $name)
    {
        $client = $this->getClientManager()->findBy(['msisdn' => $msisdn]);
        if ($client) {
            return $client;
        }

        return $this->getClientManager()->create(new ParameterBag(['msisdn' => $msisdn, 'name' => $name]));
    }

    /**
     * @param ParameterBag $bag
     *
     * @return ParameterBag
     */
    private function prepareData($bag)
    {
        /**
         * date         => "10-12-2015 23:56",
         * description  => "1wwww",
         * directionId  => "1"
         * duration     => "30m"
         * msisdn       => "384654654546"
         * name         => "Trt"
         * officeId     => "1"
         */
        $data = [
            'client' => $this->getClient($bag->get('msisdn'), $bag->get('name')),

        ];
        $client = $this->getClient($bag->get('msisdn'), $bag->get('name'));


    }

    public function createController(Request $request)
    {
        $manager = $this->getAppointmentManager();
        try {

        } catch (\Exception $e) {

        }
    }
}