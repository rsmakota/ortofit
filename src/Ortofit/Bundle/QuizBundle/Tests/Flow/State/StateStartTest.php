<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Flow\State;

use Ortofit\Bundle\QuizBundle\Flow\State\StateInterface;
use Ortofit\Bundle\QuizBundle\Flow\State\StateStart;
use Ortofit\Bundle\QuizBundle\Tests\Mock\QuizObjectsMock;
use Ortofit\Bundle\QuizBundle\Tests\Mock\RequestMock;
use Ortofit\Bundle\QuizBundle\Tests\Mock\Session;
use Ortofit\Bundle\QuizBundle\Tests\Mock\TemplateEngine;

/**
 * Class StateStartTest
 *
 * @package Ortofit\Bundle\QuizBundle\Tests\Flow\State
 */
class StateStartTest extends \PHPUnit_Framework_TestCase
{
    use QuizObjectsMock, Session, TemplateEngine, RequestMock;

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getSession()
    {
        $session  = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\SessionInterface', ['set'])->getMock();

        return $session;
    }

    /**
     * @return StateInterface
     */
    protected function createState()
    {
        $template = $this->mockTemplateEngine();
        $state = new StateStart($template);

        return $state;
    }

    /**
     * @return \Ortofit\Bundle\QuizBundle\Entity\Quiz
     */
    protected function getEntityData()
    {
        return $this->getQuiz();
    }

    /**
     * @return array
     */
    protected function getRequestData()
    {
        return [StateStart::STATE_NAME_START => StateStart::STATE_NAME_START];
    }

    /**
     * @return void
     */
    public function testProcess()
    {

        $session = $this->getSession();
        $request = $this->getRequest($this->getRequestData());
        $state   = $this->createState();
        $state->setEntityData($this->getEntityData());
        $state->process($session, $request);

        $this->assertNotEmpty($state->createResponse());
        $this->assertTrue($state->isCompleted());
    }

    /**
     * @return void
     */
    public function testIsResult()
    {
        $state = $this->createState();
        $this->assertFalse($state->isResultState());
    }
}