<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Flow\State;

use Doctrine\Common\Collections\ArrayCollection;
use Ortofit\Bundle\QuizBundle\Flow\State\StateInterface;
use Ortofit\Bundle\QuizBundle\Flow\State\StateQuestion;


/**
 * Class StateQuestionTest
 *
 * @package Ortofit\Bundle\QuizBundle\Tests\Flow\State
 */
class StateQuestionTest extends StateStartTest
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getSession()
    {
        $session  = $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\SessionInterface')->getMock();
        $session->expects($this->once())->method('set')->with(StateQuestion::SESSION_PARAM_VARIANTS, [1 => 'question_1']);

        return $session;
    }

    protected function getEntityData()
    {
        $question = $this->getQuestion();
        $question->setVariants(new ArrayCollection([$this->getVariant()]));

        return $question;
    }

    /**
     * @return StateInterface
     */
    protected function createState()
    {
        $template = $this->mockTemplateEngine();
        $state = new StateQuestion($template);

        return $state;
    }

    /**
     * @return array
     */
    protected function getRequestData()
    {
        return [StateQuestion::STATE_NAME_QUESTION."_1" => StateQuestion::STATE_NAME_QUESTION."_1"];
    }

}