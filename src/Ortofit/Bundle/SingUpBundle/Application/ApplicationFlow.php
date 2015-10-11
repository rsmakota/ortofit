<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Application;

use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Ortofit\Bundle\SingUpBundle\Service\ClientManager;
use Ortofit\Bundle\SingUpBundle\Service\OrderManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

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
     * @var ClientManager
     */
    protected $clientManager;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * ApplicationFlow constructor.
     * @param OrderManager    $orderManager
     * @param ClientManager   $clientManager
     */
    public function __construct(OrderManager $orderManager, ClientManager $clientManager)
    {
        $this->orderManager   = $orderManager;
        $this->clientManager  = $clientManager;
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
     * @return void
     */
    public function createForm()
    {
        // TODO: Implement init() method.
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        //return $this->templateEngine->render($this->application->, $this->formatResponseData());
    }
}