<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Flow;

/**
 * Class FlowTest
 *
 * @package Ortofit\Bundle\QuizBundle\Tests\Flow
 */
class FlowTest extends \PHPUnit_Framework_TestCase
{
    protected function getState()
    {
        $state = $this->getMockBuilder('Ortofit\Bundle\QuizBundle\Flow\State')->getMock();
        $state->method('process');
        $state->method('isCompleted')->will($this->returnValue(true));
        $state->method('isResultState')->will($this->returnValue(true));

        return $state;
    }
    /**
     * @return void
     */
    public function testFlow()
    {

    }
}