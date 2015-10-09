<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author    Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Controller;

use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Service\ApplicationManager;
use Ortofit\Bundle\SingUpBundle\Service\ClientManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ortofit\Bundle\SingUpBundle\Entity\Country;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SingUpController
 *
 * @package Ortofit\Bundle\SingUpBundle\Controller
 */
class SingUpController extends Controller
{
    /**
     * @param string $iso2
     *
     * @return Country
     * @throws \Exception
     */
    private function findCountry($iso2)
    {
        $country = $this->getDoctrine()->getManager()->getRepository(Country::clazz())->findOneBy(['iso2' => $iso2]);
        if (null == $country) {
            throw new \Exception('Can\'t find country by code ');
        }

        return $country;
    }

    /**
     * @return ClientManager
     */
    private function getClientManager()
    {
        return $this->get('ortofit_sing_up.client_manager');
    }

    /**
     * @return ApplicationManager
     */
    private function getApplicationManager()
    {
        return $this->get('ortofit_sing_up.application_manager');
    }

    /**
     * @param Request $request
     * @param string  $countryIso2
     */
    private function sessionInit($request, $countryIso2)
    {
        $session = $request->getSession();
        if (!$session->has('token')) {
            $session->set('token', md5(time()));
        }
        $session->set('countryIso2', $countryIso2);
    }

    /**
     * @param string           $token
     * @param SessionInterface $session
     *
     * @return bool
     * @throws \Exception
     */
    private function tokenValidate($token, $session)
    {
        if (!empty($token) && $session->has('token') && ($session->get('token') == $token)) {
            return true;
        }
        throw new \Exception('Token is invalid or empty');
    }


    /**
     * @param Country          $country
     * @param SessionInterface $session
     *
     * @return array
     */
    private function formatData($country, $session)
    {
        return [
            'prefix'  => $country->getPrefix(),
            'pattern' => $country->getPattern(),
            'token'   => $session->get('token'),
            'url'     => $this->generateUrl('ortofit_sing_up_add')
        ];
    }

    /**
     * @param string  $msisdn
     * @param Country $country
     *
     * @return null|Client
     */
    private function getClient($msisdn, $country)
    {
        $client = $this->getClientManager()->findByMsisdn($msisdn);
        if ($client) {
            return $client;
        }

        return $this->getClientManager()->create(new ParameterBag(['msisdn'=>$msisdn, 'country'=>$country]));
    }

    /**
     * @param Client $client
     *
     * @return \Ortofit\Bundle\SingUpBundle\Entity\Application
     */
    private function createApplication($client)
    {
        return $this->getApplicationManager()->create(new ParameterBag(['client'=>$client, 'type'=>Application::TYPE_VISIT]));
    }

    /**
     * @param Client $client
     *
     * @return int
     */
    private function sendMail($client)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Запись на прием')
            ->setFrom('ortofit.stelka@gmail.com')
            ->setTo('rsmakota@gmail.com')
            ->setBody('Прошу перезвонить мне по тел. +'.$client->getMsisdn().' и записать на прием.', 'text/plain');

        return $this->get('swiftmailer.mailer.default')->send($message);
    }


    /**
     * @param Request $request
     * @param string  $countryIso2
     *
     * @return Response
     */
    public function indexAction(Request $request, $countryIso2)
    {
        $this->sessionInit($request, $countryIso2);
        $session = $request->getSession();
        try {
            $country = $this->findCountry($countryIso2);

            return $this->render('OrtofitSingUpBundle:SingUp:index.html.twig', $this->formatData($country, $session));
        } catch (\Exception $e) {
            return $this->render('OrtofitSingUpBundle:SingUp:badRequest.html.twig');
        }
    }



    /**
     * @param Request $request
     *
     * @return Response
     */
    public function postAction(Request $request)
    {
        $session = $request->getSession();
        $token   = $request->request->get('token');
        try {
            $this->tokenValidate($token, $session);
            $country = $this->findCountry($session->get('countryIso2'));
            $msisdn = $request->request->get('msisdn');
            $country->validateMsisdn($msisdn);
            $client = $this->getClient($msisdn, $country);
            $this->createApplication($client);
            //$this->sendMail($client);

            return new Response('success');
        } catch (\Exception $e) {

            return new Response('fail');
        }



    }
}