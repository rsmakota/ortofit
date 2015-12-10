<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Ortofit\Bundle\BackOfficeBundle\EntityManager\OfficeManager;
use Ortofit\Bundle\SingUpBundle\Entity\Appointment;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\AppointmentManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ClientManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\CountryManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ClientDirectionManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ServiceManager;
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
     * @return ServiceManager
     */
    private function getServiceManager()
    {
        return $this->get('ortofit_back_office.service_manage');
    }


    /**
     * @param ParameterBag $bag
     *
     * @return Client
     */
    private function getClient($bag)
    {
        $client = $this->getClientManager()->findOneBy(['msisdn' => $bag->get('msisdn')]);
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

     * @return array
     */
    private function prepareAppData($bag)
    {
        return [
            'id'          => $bag->get('appId'),
            'client'      => $this->getClient($bag),
            'dateTime'    => new \DateTime($bag->get('dateTime')),
            'duration'    => $bag->get('duration'),
            'description' => $bag->get('description'),
            'office'      => $this->getOfficeManager()->get($bag->get('officeId')),
            'service'     => $this->getServiceManager()->get($bag->get('serviceId')),
        ];
    }

    /**
     * @param ParameterBag $bag
     *
     * @return ParameterBag
     */
    private function createAppointment($bag)
    {
        $data = $this->prepareAppData($bag);
        $this->getAppointmentManager()->create(new ParameterBag($data));
    }

    /**
     * @param ParameterBag $bag
     *
     * @return ParameterBag
     */
    private function updateAppointment($bag)
    {

        $data = $this->prepareAppData($bag);
        $this->getAppointmentManager()->update(new ParameterBag($data));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $offices = $this->getOfficeManager()->all();
        $activeOfficeId = $offices[0]->getId();

        return $this->render('@OrtofitBackOffice/Appointment/index.html.twig', ['offices' => $offices, 'activeOfficeId'=>$activeOfficeId]);
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
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateAction(Request $request)
    {
        try {
            $this->updateAppointment($request->request);

            return new JsonResponse(['success' => 'ok']);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => 'nok', 'error' => $e->getMessage(), 'trace'=>$e->getTrace(), 'data' => $request->request->all()]);
        }
    }
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteAction(Request $request)
    {
        try {
            $this->getAppointmentManager()->remove($request->get('appId'));

            return new JsonResponse(['success' => 'ok']);
        } catch (\Exception $e) {
            return new JsonResponse(['success' => 'nok', 'error' => $e->getMessage(), 'trace'=>$e->getTrace(), 'data' => $request->request->all()]);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction(Request $request)
    {
        $data = [
            'directions' => $this->getClientDirectionManager()->all(),
            'offices'    => $this->getOfficeManager()->all(),
            'services'   => $this->getServiceManager()->all()
        ];

        if ($request->get('appId')) {
            /** @var Appointment $app */
            $app = $this->getAppointmentManager()->get($request->get('appId'));
            $data['serviceId']   = $app->getService()->getId();
            $data['msisdn']      = $app->getClient()->getMsisdn();
            $data['clientName']  = $app->getClient()->getName();
            $data['directionId'] = $app->getClient()->getClientDirection()->getId();
            $data['officeId']    = $app->getOffice()->getId();
            $data['date']        = $app->getDateTime()->format('d/m/Y');
            $data['time']        = $app->getDateTime()->format('H:i');
            $data['duration']    = $app->getDuration();
            $data['description'] = $app->getDescription();
            $data['appId']       = $app->getId();
        }

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

        if (null != $request->get('start')) {
            $fromDay = new \DateTime($request->get('start'));
        }
        if (null != $request->get('end')) {
            $toDay = new \DateTime($request->get('end'));
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

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function preOrderAction(Request $request)
    {
        /** @var Appointment $app */
        $app = $this->getAppointmentManager()->get($request->get('appId'));
        $data =[
            'appId'       => $app->getId(),
            'msisdn'      => $app->getClient()->getMsisdn(),
            'name'        => $app->getClient()->getName(),
            'direction'   => $app->getClient()->getClientDirection()->getName(),
            'office'      => $app->getOffice()->getName(),
            'date'        => $app->getDateTime()->format('Y-m-d'),
            'time'        => $app->getDateTime()->format('H:i'),
            'duration'    => $app->getDuration(),
            'service'     => $app->getService()->getName(),
            'description' => $app->getDescription()
        ];

        return $this->render('@OrtofitBackOffice/Appointment/preOrderModal.html.twig', $data);
    }
}