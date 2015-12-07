<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Ortofit\Bundle\BackOfficeBundle\EntityManager\OfficeManager;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\AppointmentManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ClientManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\CountryManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ClientDirectionManager;
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
     * @return ClientDirectionManager
     */
    private function getClientDirectionManager()
    {
        return $this->get('ortofit_back_office.client_direction_manage');
    }
    /**
     * @return CountryManager
     */
    private function getCountryManager()
    {
        return $this->get('ortofit_back_office.client_country_manage');
    }
    /**
     * @return ClientManager
     */
    private function getClientManager()
    {
        return $this->get('ortofit_back_office.client_manage');
    }
    /**
     * @return OfficeManager
     */
    private function getOfficeManager()
    {
        return $this->get('ortofit_back_office.office_manage');
    }

    /**
     * @param ParameterBag $bag
     *
     * @return Client
     */
    private function getClient($bag)
    {
        $client = $this->getClientManager()->findBy(['msisdn' => $bag->get('msisdn')]);
        if ($client) {
            return $client;
        }
        $data = [
            'msisdn'          => $bag->get('msisdn'),
            'name'            => $bag->get('clientName'),
            'country'         => $this->getCountryManager()->getDefault(),
            'clientDirection' => $this->getClientDirectionManager()->get($bag->get('clientDirectionId'))
        ];

        return $this->getClientManager()->create(new ParameterBag($data));
    }

    /**
     * @param ParameterBag $bag
     *
     * @return ParameterBag
     */
    private function createAppointment($bag)
    {

        $data = [
            'client'      => $this->getClient($bag),
            'dateTime'    => new \DateTime($bag->get('dateTime')),
            'duration'    => $bag->get('duration'),
            'description' => $bag->get('description'),
            'office'      => $this->getOfficeManager()->get($bag->get('officeId'))
        ];
        $this->getAppointmentManager()->create(new ParameterBag($data));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function createAction(Request $request)
    {
        try {
            $this->createAppointment($request->request);

            return new JsonResponse(['success' => 'ok']);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => 'nok', 'error' => $e->getMessage(), 'trace'=>$e->getTrace(), 'data' => $request->request->all()]);
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction()
    {
        $data = [
            'directions' => $this->getClientDirectionManager()->all(),
            'offices'    => $this->getOfficeManager()->all()
        ];

        return $this->render('@OrtofitBackOffice/Appointment/createForm.html.twig', $data);
    }



    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAppAction(Request $request)
    {
        $fromDay = new \DateTime('first day of this month');
        $toDay   = new \DateTime('last day of this month');

        if (null != $request->get('from')) {
            $fromDay = new \DateTime($request->get('from'));
        }
        if (null != $request->get('to')) {
            $toDay = new \DateTime($request->get('to'));
        }
        $data = [
            'from'      => $fromDay,
            'to'        => $toDay,
            'office_id' => $request->get('office_id')
        ];
        $app = $this->getAppointmentManager()->findByRange(new ParameterBag($data));
        $responseData = [];
        foreach ($app as $appointment) {
            $responseData[] = $appointment->getCalendarData();
        }

        return new JsonResponse($responseData);
    }
}