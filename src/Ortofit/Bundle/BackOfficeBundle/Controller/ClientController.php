<?php

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Ortofit\Bundle\BackOfficeBundle\Paginator\Paginator;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Entity\Country;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class ClientController extends BaseController
{

    private function getLimit()
    {
        return 20;
    }

    /**
     * @return null|Country
     */
    protected function getCountry()
    {
        return $this->get('ortofit_back_office.client_country_manage')->getDefault();
    }

    /**
     * @param integer $current
     * @return Paginator
     */
    private function getPaginator($current)
    {
        $limit = $this->getLimit();
        $count = $this->getClientManager()->count();

        return new Paginator($limit, $current, $count);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $manager   = $this->getClientManager();
        $paginator = $this->getPaginator($request->get('page', 1));
        $limit     = $this->getLimit();
        $clients   = $manager->findBy([],[], $limit, ($limit * ($paginator->current()-1)));
        $data = [
            'paginator' => $paginator,
            'clients'   => $clients,
        ];

        return $this->render('@OrtofitBackOffice/Client/index.html.twig', $data);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction(Request $request)
    {
        $data = [
            'directions' => $this->getClientDirectionManager()->all()
        ];

        if ($request->get('id')) {
            /** @var Client $client */
            $client = $this->getClientManager()->get($request->get('id'));
            $data['msisdn']      = $client->getMsisdn();
            $data['name']  = $client->getName();
            $data['clientDirectionId'] = $client->getClientDirection()->getId();
        }

        return $this->render('@OrtofitBackOffice/Client/createForm.html.twig', $data);
    }

    public function createAction(Request $request)
    {
        try {
            $data = [
                'country'         => $this->getCountry(),
                'clientDirection' => $this->getClientDirectionManager()->get($request->get('clientDirectionId')),
                'msisdn'          => $request->get('msisdn'),
                'name'            => $request->get('name')
            ];
            $this->getClientManager()->create(new ParameterBag($data));

            return $this->createSuccessJsonResponse();
        } catch (\Exception $e) {
            return $this->createFailJsonResponse($e, $request->request->all());
        }
    }

    public function updateAction(Request $request)
    {
        try {
            $data = [
                'country'         => $this->getCountry(),
                'clientDirection' => $this->getClientDirectionManager()->get($request->get('clientDirectionId')),
                'msisdn'          => $request->get('msisdn'),
                'name'            => $request->get('name'),
                'id'              => $request->get('id')
            ];
            $this->getClientManager()->update(new ParameterBag($data));

            return $this->createSuccessJsonResponse();
        } catch (\Exception $e) {
            return $this->createFailJsonResponse($e, $request->request->all());
        }
    }


}
