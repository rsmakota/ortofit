<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author    Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Controller;

use Ortofit\Bundle\SingUpBundle\Application\ApplicationFlowInterface;
use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Service\ApplicationManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SingUpController
 *
 * @package Ortofit\Bundle\SingUpBundle\Controller
 */
class SingUpController extends Controller
{
    /**
     * @return ApplicationManager
     */
    private function getAppManager()
    {
        return $this->get('ortofit_sing_up.application_manager');
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
     * @param Application $app
     *
     * @return ApplicationFlowInterface
     */
    private function getAppFlow($app)
    {
        /** @var ApplicationFlowInterface $appFlow */
        $appFlow = $this->get($app->getFlowServiceName());
        $appFlow->setApplication($app);

        return $appFlow;
    }

    /**
     * @param Request $request
     *
     * @return string
     * @throws \Exception
     */
    private function getAppId(Request $request)
    {
        if (!$request->request->has(ApplicationFlowInterface::SESSION_APPLICATION_ID)) {
            throw new \Exception('Request does\'t have token parameter');
        }

        return $request->request->get(ApplicationFlowInterface::SESSION_APPLICATION_ID);
    }

    /**
     * @param integer $appId
     *
     * @return Response
     */
    public function indexAction($appId)
    {
        try {
            $app     = $this->getAppManager()->getApp($appId);
            $appFlow = $this->getAppFlow($app);
            $appFlow->createForm();

            return new Response($appFlow->getResponse());
        } catch (\Exception $e) {

            return new Response(ApplicationFlowInterface::RESPONSE_FAIL);
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function processAction(Request $request)
    {
        try {
            $appId   = $this->getAppId($request);
            $app     = $this->getAppManager()->getApp($appId);
            $appFlow = $this->getAppFlow($app);
            $appFlow->action($request->getMethod(), $request->request);

            return new Response($appFlow->getResponse());
        } catch (\Exception $e) {
            return new Response(ApplicationFlowInterface::RESPONSE_FAIL);
        }
    }
}