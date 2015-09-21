<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Result;

/**
 * Class Result
 *
 * @package Ortofit\Bundle\QuizBundle\Result
 */
class Result implements ResultInterface
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
     * Result constructor.
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