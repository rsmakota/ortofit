<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Factory\State;

use Ortofit\Bundle\QuizBundle\Entity\Question;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Ortofit\Bundle\QuizBundle\Factory\State\SimpleStateFactory;
use Ortofit\Bundle\QuizBundle\Factory\State\StateFactoryInterface;
use Ortofit\Bundle\QuizBundle\Tests\Mock\TemplateEngine;

/**
 * Class SimpleStateFactoryTest
 *
 * @package Ortofit\Bundle\QuizBundle\Tests\Factory\State
 */
class SimpleStateFactoryTest extends \PHPUnit_Framework_TestCase
{
    use TemplateEngine;
    /**
     * @return void
     */
    public function testCreate()
    {
        $templateEngine = $this->mockTemplateEngine();
        //$resultManager  = $this->getMockBuilder('Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticInterface')->getMock();
        $factory  = new SimpleStateFactory($templateEngine);

        $quiz     = new Quiz();
        $question = new Question();

        $startState    = $factory->createState(StateFactoryInterface::STATE_TYPE_START, $quiz);
        $resultState   = $factory->createState(StateFactoryInterface::STATE_TYPE_RESULT, $question);
        $questionState = $factory->createState(StateFactoryInterface::STATE_TYPE_QUESTION, $quiz);

        $this->assertInstanceOf('Ortofit\Bundle\QuizBundle\Flow\State\StateStart', $startState);
        $this->assertInstanceOf('Ortofit\Bundle\QuizBundle\Flow\State\StateResult', $resultState);
        $this->assertInstanceOf('Ortofit\Bundle\QuizBundle\Flow\State\StateQuestion', $questionState);
        try {
            $factory->createState('unknown', $quiz);
            $this->assertEquals(false, true, 'There is something wrong');
        } catch (\Exception $e) {
            $this->assertEquals('The Method createUnknownState isn\'t exist', $e->getMessage());
        }
    }
}