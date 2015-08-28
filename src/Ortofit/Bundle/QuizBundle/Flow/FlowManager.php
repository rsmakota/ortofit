<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow;

use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Ortofit\Bundle\QuizBundle\Factory\State\StateFactoryInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class FlowManager
 *
 * @package Ortofit\Bundle\QuizBundle\Flow
 */
class FlowManager
{
    /**
     * @var StateFactoryInterface
     */
    private $stateFactory;

    /**
     * FlowManager constructor.
     *
     * @param StateFactoryInterface $factory
     */
    public function __construct(StateFactoryInterface $factory)
    {
        $this->stateFactory = $factory;
    }

    /**
     * @param Quiz $quiz
     *
     * @return array
     */
    private function createStates(Quiz $quiz)
    {
        $quizBag = new ParameterBag(['quiz' => $quiz]);
        $states = [$this->stateFactory->createState(StateFactoryInterface::STATE_TYPE_START, $quizBag)];
        foreach ($quiz->getQuestions() as $question) {
            $bag = new ParameterBag(['question' => $question]);
            $states[] = $this->stateFactory->createState(StateFactoryInterface::STATE_TYPE_QUESTION, $bag);
        }
        $states[] = $this->stateFactory->createState(StateFactoryInterface::STATE_TYPE_RESULT, $quizBag);

        return $states;
    }

    /**
     * @param Quiz $quiz
     *
     * @return Flow
     */
    public function createFlow(Quiz $quiz)
    {
        return new Flow($this->createStates($quiz));
    }
}