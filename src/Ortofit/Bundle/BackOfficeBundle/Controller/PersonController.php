<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PersonController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class PersonController extends BaseController
{
    /**
     * @return \Ortofit\Bundle\BackOfficeBundle\EntityManager\PersonManager
     */
    private function getPersonManager()
    {
        return $this->get('ortofit_back_office.person_manage');
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $manager   = $this->getClientManager();
        $clients   = $manager->get($request->get('clientId'));
        $data = [
            'client' => $clients,
        ];

        return $this->render('@OrtofitBackOffice/Person/index.html.twig', $data);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction(Request $request)
    {
        $client = $this->getClientManager()->get($request->get('client_Id'));
        $data = [
            'client' => $client
        ];

        if ($request->get('id')) {
            $data['person'] = $this->getPersonManager()->get($request->get('id'));
        }

        return $this->render('@OrtofitBackOffice/Person/createForm.html.twig', $data);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction(Request $request)
    {
        try {
            $data = [
                'client'       => $this->getClientManager()->get($request->get('client_Id')),
                'born'         => $request->get('born'),
                'name'         => $request->get('name'),
                'familyStatus' => $request->get('familyStatus'),
            ];
            $this->getPersonManager()->create(new ParameterBag($data));

            return $this->createSuccessJsonResponse();
        } catch (\Exception $e) {
            return $this->createFailJsonResponse($e, $request->request->all());
        }
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $request)
    {
        try {
            $data = [
                'country' => $this->getCountry(),
                'clientDirection' => $this->getClientDirectionManager()->get($request->get('clientDirectionId')),
                'msisdn' => $request->get('msisdn'),
                'name' => $request->get('name'),
                'gender' => $request->get('gender'),
                'id' => $request->get('id')
            ];
            $this->getClientManager()->update(new ParameterBag($data));

            return $this->createSuccessJsonResponse();
        } catch (\Exception $e) {
            return $this->createFailJsonResponse($e, $request->request->all());
        }
    }
}