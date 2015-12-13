<?php

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Ortofit\Bundle\BackOfficeBundle\Paginator\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class ClientController extends Controller
{

    private function getClientManager()
    {
        return $this->get('ortofit_back_office.client_manage');
    }

    private function getLimit()
    {
        return 20;
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
}
