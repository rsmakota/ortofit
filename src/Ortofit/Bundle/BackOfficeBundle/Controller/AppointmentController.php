<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Ortofit\Bundle\SingUpBundle\Entity\Appointment;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AppointmentController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class AppointmentController extends BaseController
{

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
            'gender'          => $bag->get('gender'),
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

            return $this->createSuccessJsonResponse();
        } catch (\Exception $e) {
            return $this->createFailJsonResponse($e, $request->request->all());
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

            return $this->createSuccessJsonResponse();
        } catch (\Exception $e) {
            return $this->createFailJsonResponse($e, $request->request->all());
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

            return $this->createSuccessJsonResponse();
        } catch (\Exception $e) {
            return $this->createFailJsonResponse($e, $request->request->all());
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
            $data['gender']      = $app->getClient()->getGender();
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
            'description' => $app->getDescription(),
            'gender'      => $app->getClient()->getGender()
        ];

        return $this->render('@OrtofitBackOffice/Appointment/preOrderModal.html.twig', $data);
    }
}