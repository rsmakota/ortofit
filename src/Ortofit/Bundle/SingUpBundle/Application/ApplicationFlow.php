<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Application;

use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Ortofit\Bundle\SingUpBundle\Notify\NotifyManagerInterface;
use Ortofit\Bundle\SingUpBundle\Service\AbstractManager;
use Ortofit\Bundle\SingUpBundle\Service\OrderManager;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class ApplicationFlow
 *
 * @package Ortofit\Bundle\SingUpBundle\Application
 */
class ApplicationFlow implements ApplicationFlowInterface
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * @var EngineInterface
     */
    protected $templateEngine;

    /**
     * @var OrderManager
     */
    protected $orderManager;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var string
     */
    protected $response;

    /**
     * @var string
     */
    protected $processRouteId;

    /**
     * @var NotifyManagerInterface
     */
    private $notifyManager;

    /**
     * @param OrderManager           $orderManager
     * @param NotifyManagerInterface $notifyManager
     */
    public function __construct(OrderManager $orderManager, NotifyManagerInterface $notifyManager)
    {
        $this->orderManager  = $orderManager;
        $this->notifyManager = $notifyManager;
    }

    /**
     * @return string
     */
    private function getToken()
    {
        return $this->session->get(ApplicationFlowInterface::SESSION_APP_TOKEN);
    }

    /**
     * @return void
     */
    private function initToken()
    {
        $this->session->set(ApplicationFlowInterface::SESSION_APP_TOKEN, md5(time()));
    }

    /**
     * @param string $processRouteId
     */
    public function setProcessRouteId($processRouteId)
    {
        $this->processRouteId = $processRouteId;
    }

    /**
     * @param EngineInterface $templateEngine
     */
    public function setTemplateEngine(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param SessionInterface $session
     */
    public function setSession(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param Application $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }

    /**
     * @return array
     */
    protected function formatFormData()
    {
        return [
            'prefix'  => $this->application->getCountry()->getPrefix(),
            'pattern' => $this->application->getCountry()->getPattern(),
            'token'   => $this->getToken(),
            'routeId' => $this->processRouteId,
            'appId'   => $this->application->getId()
        ];
    }
    /**
     * @return void
     */
    public function createForm()
    {
        $this->initToken();
        $templateName   = $this->application->getTemplateName();
        $this->response = $this->templateEngine->render($templateName, $this->formatFormData());
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string $token
     *
     * @return boolean
     * @throws \Exception
     */
    public function tokenValidate($token)
    {
        if (!empty($token) &&
            $this->session->has(ApplicationFlowInterface::SESSION_APP_TOKEN) &&
            ($this->session->get(ApplicationFlowInterface::SESSION_APP_TOKEN) == $token)
        ) {
            return true;
        }
        $sessionToken = $this->session->get(ApplicationFlowInterface::SESSION_APP_TOKEN);

        throw new \Exception(sprintf('Token is invalid or empty. Expects <<%s>> but gotten <<%s>>', $sessionToken, $token));
    }

    /**
     * @param string       $action
     * @param ParameterBag $bag
     *
     * @throws \Exception
     */
    public function action($action, ParameterBag $bag)
    {
        $this->tokenValidate($bag->get(ApplicationFlowInterface::SESSION_APP_TOKEN));
        $method = $action . "Action";
        if (!method_exists($this, $method)) {
            throw new \Exception(sprintf('This flow doesn\'t support method <<%s>>', $action));
        }
        $this->$method($bag);
    }

    /**
     * @param ParameterBag $bag
     */
    private function postAction(ParameterBag $bag)
    {
        $msisdn = $bag->get(AbstractManager::PARAM_MSISDN);
        $params = [
            AbstractManager::PARAM_MSISDN => $msisdn,
            AbstractManager::PARAM_APP    => $this->application
        ];
        $bag = new \Symfony\Component\DependencyInjection\ParameterBag\ParameterBag($params);
        $this->orderManager->create($bag);
        $this->response = self::RESPONSE_SUCCESS;
    }
}