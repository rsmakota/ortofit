<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author    Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Controller;

use Ortofit\Bundle\SingUpBundle\Application\ApplicationFlowInterface;
use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Ortofit\Bundle\SingUpBundle\Security\SecurityInterface;
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
     * @return \Symfony\Bridge\Monolog\Logger
     */
    private function getLogger()
    {
        return $this->get('monolog.logger.sing_up');
    }

    /**
     * @return SecurityInterface
     */
    private function getSecurity()
    {
        return $this->get('ortofit_sing_up.sing_up_security');
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
        if (!$request->request->has(ApplicationFlowInterface::SESSION_APP_ID)) {
            throw new \Exception('Request does\'t have token parameter');
        }

        return $request->request->get(ApplicationFlowInterface::SESSION_APP_ID);
    }

    /**
     * @param integer $appId
     *
     * @return Response
     */
    public function indexAction($appId)
    {
        $security = $this->getSecurity();
        $security->init();
        try {
            $app     = $this->getAppManager()->getApp($appId);
            $appFlow = $this->getAppFlow($app);
            $appFlow->createForm($security->getSecurityContext());

            return new Response($appFlow->getResponse());
        } catch (\Exception $e) {
            $this->getLogger()->addError(' | INDEX | ' . $e->getMessage(), ['appId' => $appId]);

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
            $this->getSecurity()->validate($request);
            $appId   = $this->getAppId($request);
            $app     = $this->getAppManager()->getApp($appId);
            $appFlow = $this->getAppFlow($app);
            $appFlow->process($request->getMethod(), $request->request);

            return new Response($appFlow->getResponse());
        } catch (\Exception $e) {
            $this->getLogger()->addError(' | PROCESS | ' . $e->getMessage(), [$request->request->all(), $e->getTraceAsString()]);

            return new Response(ApplicationFlowInterface::RESPONSE_FAIL);
        }
    }
}