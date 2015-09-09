<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */
namespace Ortofit\Bundle\QuizBundle\Controller;

use Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticInterface;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class QuizController
 *
 * @package Ortofit\Bundle\QuizBundle\Controller
 */
class QuizController extends Controller
{
    /**
     * @param integer $quizId
     *
     * @return Quiz|null
     */
    private function findQuiz($quizId)
    {
        return $this->getDoctrine()->getManager()->getRepository(Quiz::clazz())->find($quizId);
    }

    /**
     * @param string $serviceId
     *
     * @return DiagnosticInterface
     */
    private function findResultManager($serviceId)
    {
        return $this->get($serviceId);
    }

    /**
     * @return \Ortofit\Bundle\QuizBundle\Flow\FlowManager
     */
    private function getFlowManager()
    {
        return $this->get('ortofit_quiz.flow_manager');
    }

    /**
     * @param Request $request
     * @param integer $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $id)
    {
        $session = $request->getSession();
        $quiz = $this->findQuiz($id);
        $resultManager = $this->findResultManager($quiz->getResultManagerId());
        $flow = $this->getFlowManager()->createFlow($quiz, $resultManager);
        $flow->fill($session);
        $flow->process($session, $request);

        return new Response($flow->createResponse());
    }
}
