<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow;

use Ortofit\Bundle\QuizBundle\Result\ResultManagerInterface;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Ortofit\Bundle\QuizBundle\Factory\State\StateFactoryInterface;

/**
 * Class FlowManager
 *
 * @package Ortofit\Bundle\QuizBundle\Flow
 */
class FlowManager implements FlowManagerInterface
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
     * @param Quiz                   $quiz
     * @param ResultManagerInterface $resultManager
     *
     * @return array
     */
    private function createStates(Quiz $quiz, ResultManagerInterface $resultManager)
    {
        $states = [$this->stateFactory->createState(StateFactoryInterface::STATE_TYPE_START, $quiz)];
        foreach ($quiz->getQuestions() as $question) {
            $states[] = $this->stateFactory->createState(StateFactoryInterface::STATE_TYPE_QUESTION, $question);
        }
        $resultState = $this->stateFactory->createState(StateFactoryInterface::STATE_TYPE_RESULT, $quiz);
        $resultState->setResultManager($resultManager);
        $states[] = $resultState;

        return $states;
    }

    /**
     * @param Quiz                   $quiz
     * @param ResultManagerInterface $resultManager
     *
     * @return Flow
     */
    public function createFlow(Quiz $quiz, ResultManagerInterface $resultManager)
    {
        return new Flow($this->createStates($quiz, $resultManager));
    }
}