<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow\State;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Templating\EngineInterface;
/**
 * Class AbstractState
 *
 * @package Ortofit\Bundle\QuizBundle\Flow\State
 */
abstract class AbstractState implements StateInterface
{
    const STATE_NAME_START  = 'start';
    const STATE_NAME_RESULT = 'result';

    /**
     * @var string
     */
    protected $template;
    /**
     * @var EngineInterface
     */
    protected $templateEngine;
    /**
     * @var boolean
     */
    protected $completed = false;
    /**
     * variant id
     * @var mixed
     */
    protected $stateResult = null;



    /**
     * @param EngineInterface  $templateEngine
     */
    public function __construct(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @return boolean
     */
    public function isCompleted()
    {
        return $this->completed;
    }
    /**
     * @param SessionInterface $session
     */
    public function fill(SessionInterface $session)
    {
        if ($session->has($this->getId())) {
            $this->stateResult = $session->get($this->getId());
        }
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
    /**
     * @return array
     */
    abstract protected function formatResponseData();

    /**
     * @return string
     */
    public function createResponse()
    {
        return $this->templateEngine->render($this->template, $this->formatResponseData());
    }
}