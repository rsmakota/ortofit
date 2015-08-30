<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Diagnostic;

/**
 * Class DiagnosticResult
 *
 * @package Ortofit\Bundle\QuizBundle\Diagnostic
 */
class DiagnosticResult implements DiagnosticResultInterface
{
    /**
     * @var string
     */
    private $outcome;
    /**
     * @var string
     */
    private $recommendation;
    /**
     * @var boolean
     */
    private $positive;

    /**
     * DiagnosticResult constructor.
     * @param string  $outcome
     * @param string  $recommendation
     * @param boolean $positive
     */
    public function __construct($outcome, $recommendation, $positive)
    {
        $this->outcome        = $outcome;
        $this->recommendation = $recommendation;
        $this->positive       = $positive;
    }

    /**
     * @return string
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @return string
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * @return boolean
     */
    public function isPositive()
    {
        return $this->positive;
    }
}