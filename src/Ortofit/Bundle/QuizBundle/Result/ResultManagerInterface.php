<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Result;

/**
 * Interface DiagnosticInterface
 *
 * @package Ortofit\Bundle\QuizBundle\Diagnostic
 */
interface ResultManagerInterface
{
    /**
     * @param array $variants
     *
     * @return void
     */
    public function loadVariants($variants);

    /**
     * @param mixed $quiz
     *
     * @return void
     */
    public function setQuiz($quiz);
    /**
     * @return ResultInterface
     */
    public function createDiagnosis();

    /**
     * @return void
     */
    public function saveResult();
}