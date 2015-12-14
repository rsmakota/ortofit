<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\AppointmentManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ClientManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\CountryManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ClientDirectionManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\ServiceManager;
use Ortofit\Bundle\BackOfficeBundle\EntityManager\OfficeManager;
/**
 * Class BaseController
 * 
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class BaseController extends Controller
{
    /**
     * @param array $data
     * 
     * @return JsonResponse
     */
    protected function createSuccessJsonResponse($data = [])
    {
        return new JsonResponse(['success' => 'ok', 'data' => $data]);
    }

    /**
     * @param \Exception $exception
     * @param array      $data
     * 
     * @return JsonResponse
     */
    protected function createFailJsonResponse(\Exception $exception, $data)
    {
        return new JsonResponse(['success' => 'nok', 'error' => $exception->getMessage(), 'trace'=>$exception->getTrace(), 'data' => $data]);
    }

    /**
     * @return AppointmentManager
     */
    protected function getAppointmentManager()
    {
        return $this->get('ortofit_back_office.appointment_manage');
    }

    /**
     * @return ClientDirectionManager
     */
    protected function getClientDirectionManager()
    {
        return $this->get('ortofit_back_office.client_direction_manage');
    }
    /**
     * @return CountryManager
     */
    protected function getCountryManager()
    {
        return $this->get('ortofit_back_office.client_country_manage');
    }
    /**
     * @return ClientManager
     */
    protected function getClientManager()
    {
        return $this->get('ortofit_back_office.client_manage');
    }
    /**
     * @return OfficeManager
     */
    protected function getOfficeManager()
    {
        return $this->get('ortofit_back_office.office_manage');
    }

    /**
     * @return ServiceManager
     */
    protected function getServiceManager()
    {
        return $this->get('ortofit_back_office.service_manage');
    }
}