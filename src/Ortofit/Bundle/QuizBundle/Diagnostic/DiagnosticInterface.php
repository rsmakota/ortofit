<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Diagnostic;

/**
 * Interface DiagnosticInterface
 *
 * @package Ortofit\Bundle\QuizBundle\Diagnostic
 */
interface DiagnosticInterface
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
     * @return DiagnosticResultInterface
     */
    public function createDiagnosis();

    /**
     * @return void
     */
    public function saveResult();
}