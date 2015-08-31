<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Factory\State;


use Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticInterface;
use Ortofit\Bundle\QuizBundle\Flow\State\StateInterface;
use Ortofit\Bundle\QuizBundle\Flow\State\StateQuestion;
use Ortofit\Bundle\QuizBundle\Flow\State\StateResult;
use Ortofit\Bundle\QuizBundle\Flow\State\StateStart;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class SimpleStateFactory
 *
 * @package Ortofit\Bundle\QuizBundle\Factory\State
 */
class SimpleStateFactory implements StateFactoryInterface
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;

    /**
     * @var DiagnosticInterface
     */
    private $resultManager;

    /**
     * SimpleStateFactory constructor.
     *
     * @param EngineInterface $templateEngine
     */
    public function __construct(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param DiagnosticInterface $resultManager
     */
    public function setResultManager($resultManager)
    {
        $this->resultManager = $resultManager;
    }

    /**
     * @param string       $type
     * @param ParameterBag $bag
     *
     * @return StateInterface
     * @throws \Exception
     */
    public function createState($type, $bag)
    {
        $method = 'create'.ucfirst($type).'State';
        if (method_exists($this, $method)) {
            return $this->$method($bag);
        }

        throw new \Exception('The Method '.$method.' isn\'t exist');
    }

    /**
     * @param ParameterBag $bag
     *
     * @return StateInterface
     */
    protected function createStartState($bag)
    {
        $quiz  = $bag->get('quiz');
        $state = new StateStart($this->templateEngine);
        $state->setQuiz($quiz);
        $state->setTemplate('OrtofitQuizBundle:Quiz:start.html.twig');

        return $state;
    }

    /**
     * @param ParameterBag $bag
     *
     * @return StateInterface
     */
    protected function createQuestionState($bag)
    {
        $question = $bag->get('question');
        $state    = new StateQuestion($this->templateEngine);
        $state->setQuestion($question);
        $state->setTemplate('OrtofitQuizBundle:Quiz:question.html.twig');

        return $state;
    }

    /**
     * @param ParameterBag $bag
     *
     * @return StateInterface
     */
    protected function createResultState($bag)
    {
        $state = new StateResult($this->templateEngine);
        $state->setResultManager($this->resultManager);
        $state->setTemplate('OrtofitQuizBundle:Quiz:result.html.twig');

        return $state;
    }

}