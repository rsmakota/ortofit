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
    const STATE_NAME_START    = 'start';
    const STATE_NAME_RESULT   = 'result';
    const STATE_NAME_QUESTION = 'question';

    const SESSION_PARAM_VARIANTS = 'variants';

    /**
     * @var EngineInterface
     */
    protected $templateEngine;
    /**
     * @var boolean
     */
    protected $completed = false;

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

    abstract protected function getTemplate();
    /**
     * @return array
     */
    abstract protected function formatResponseData();

    /**
     * @return string
     */
    public function createResponse()
    {
        return $this->templateEngine->render($this->getTemplate(), $this->formatResponseData());
    }

    /**
     * @return boolean
     */
    public function isResultState()
    {
        return false;
    }

}