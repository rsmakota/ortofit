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
     * @return DiagnosticResultInterface
     */
    public function createDiagnosis();
}