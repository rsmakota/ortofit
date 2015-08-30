<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Diagnostic;


use Ortofit\Bundle\QuizBundle\Entity\Variant;

/**
 * Class DiagnosticManager
 *
 * @package Ortofit\Bundle\QuizBundle\Diagnostic
 */
class DiagnosticManager implements DiagnosticInterface
{
    /**
     * @var Variant[]
     */
    private $variants;

    /**
     * @param Variant[] $variants
     */
    public function loadVariants($variants)
    {
        $this->variants = $variants;
    }

    /**
     * @return boolean
     */
    private function isPositive()
    {
        foreach ($this->variants as $variant) {
            if (!$variant->getPositive()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    private function createOutcome()
    {
        $result = [];
        foreach ($this->variants as $variant) {
            if (null != $variant->getOutcome()) {
                $result[] = ucfirst($variant->getOutcome());
            }
        }

        return implode('. ', $result);
    }

    /**
     * @return mixed|string
     */
    private function createRecommendation()
    {
        foreach ($this->variants as $variant) {
            if (null != $variant->getRecommendation()) {
                return ucfirst($variant->getRecommendation());
            }
        }
        return '';
    }

    /**
     * @return DiagnosticResultInterface
     */
    public function createDiagnosis()
    {
        return new DiagnosticResult(
          $this->createOutcome(),
          $this->createRecommendation(),
          $this->isPositive()
        );
    }
}