<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow;

use Ortofit\Bundle\QuizBundle\Result\ResultManagerInterface;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;

/**
 * Interface FlowManagerInterface
 *
 * @package Ortofit\Bundle\QuizBundle\Flow
 */
interface FlowManagerInterface
{
    /**
     * @param Quiz                   $quiz
     * @param ResultManagerInterface $resultManager
     *
     * @return Flow
     */
    public function createFlow(Quiz $quiz, ResultManagerInterface $resultManager);
}