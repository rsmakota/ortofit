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
    private $result;
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
     *
     * @param string  $result
     * @param string  $recommendation
     * @param boolean $positive
     */
    public function __construct($result, $recommendation, $positive)
    {
        $this->result         = $result;
        $this->recommendation = $recommendation;
        $this->positive       = $positive;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
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