<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Result;

/**
 * Class DiagnosticResultInterface
 *
 * @package Ortofit\Bundle\QuizBundle\Diagnostic
 */
interface ResultInterface
{
    /**
     * @return string
     */
    public function getResult();

    /**
     * @return string
     */
    public function getRecommendation();

    /**
     * @return boolean
     */
    public function isPositive();
}