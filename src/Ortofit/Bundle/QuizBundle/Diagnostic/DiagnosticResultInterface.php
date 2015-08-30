<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Diagnostic;

/**
 * Class DiagnosticResultInterface
 *
 * @package Ortofit\Bundle\QuizBundle\Diagnostic
 */
interface DiagnosticResultInterface
{
    /**
     * @return string
     */
    public function getOutcome();

    /**
     * @return string
     */
    public function getRecommendation();

    /**
     * @return boolean
     */
    public function isPositive();
}