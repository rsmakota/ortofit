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
            'routeId' => $this->processRouteId,
            'appId'   => $this->application->getId()
        ];
    }

    /**
     * @param array $params
     *
     * @return void
     */
    public function createForm($params = [])
    {
        $templateName   = $this->application->getTemplateName();
        $templateData   = array_merge($this->formatFormData(), $params);
        $this->response = $this->templateEngine->render($templateName, $templateData);
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string       $action
     * @param ParameterBag $bag
     *
     * @throws \Exception
     */
    public function process($action, ParameterBag $bag)
    {
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