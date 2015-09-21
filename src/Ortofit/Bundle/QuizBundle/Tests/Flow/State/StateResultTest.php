<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Flow\State;

use Ortofit\Bundle\QuizBundle\Flow\State\StateInterface;
use Ortofit\Bundle\QuizBundle\Flow\State\StateResult;


/**
 * Class StateResultTest
 *
 * @package Ortofit\Bundle\QuizBundle\Tests\Flow\State
 */
class StateResultTest extends StateStartTest
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getSession()
    {
        $session  = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\SessionInterface')->getMock();
        $session->expects($this->once())->method('set')->with(StateResult::SESSION_PARAM_RESULT_SAVED, true);
        $session->expects($this->once())->method('has')->with(StateResult::SESSION_PARAM_RESULT_SAVED)->will($this->returnValue(false));
        $session->expects($this->once())->method('get')->with(StateResult::SESSION_PARAM_VARIANTS)->will($this->returnValue([]));

        return $session;
    }
    /**
     * @return StateInterface
     */
    protected function createState()
    {
        $template = $this->mockTemplateEngine();
        $resultManager = $this->getMockBuilder('Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticInterface')->getMock();
        $resultManager->expects($this->any())->method('loadVariants')->with([]);
        $resultManager->expects($this->any())->method('setQuiz');
        $resultManager->expects($this->any())->method('createDiagnosis');
        $resultManager->expects($this->any())->method('saveResult');
        $state = new StateResult($template);
        $state->setResultManager($resultManager);

        return $state;
    }

    /**
     * @return array
     */
    protected function getRequestData()
    {
        return [StateResult::STATE_NAME_RESULT => StateResult::STATE_NAME_RESULT];
    }

    /**
     * @return void
     */
    public function testIsResult()
    {
        $state = $this->createState();
        $this->assertTrue($state->isResultState());
    }
}