<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */
namespace Ortofit\Bundle\QuizBundle\Controller;

use Ortofit\Bundle\QuizBundle\Result\ResultManagerInterface;
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
     * @return \Monolog\Logger
     */
    public function getCriticalLogger()
    {
        return $this->get('monolog.logger.quiz');
    }

    /**
     * @param integer $quizId
     *
     * @return Quiz
     * @throws \Exception
     */
    private function getQuiz($quizId)
    {
        $quiz = $this->getDoctrine()->getManager()->getRepository(Quiz::clazz())->find($quizId);
        if ($quiz) {
            return $quiz;
        }
        throw new \Exception('Can\'t find the quiz with id <<'.$quizId.'>>');
    }

    /**
     * @param string $serviceId
     *
     * @return ResultManagerInterface
     */
    private function findResultManager($serviceId)
    {
        return $this->get($serviceId);
    }

    /**
     * @return \Ortofit\Bundle\QuizBundle\Flow\FlowManagerInterface
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
        try {
            $quizEnt  = $this->getQuiz($id);
            $session  = $request->getSession();
            $rManager = $this->findResultManager($quizEnt->getResultManagerId());
            $quizFlow = $this->getFlowManager()->createFlow($quizEnt, $rManager);
            $quizFlow->init($session);
            $quizFlow->process($session, $request);

            return new Response($quizFlow->createResponse());
        } catch (\Exception $e) {
            $this->getCriticalLogger()->addCritical($e->getMessage());

            return $this->redirectToRoute('ortofit_wrong_quiz');
        }
    }

    /**
     * @return Response
     */
    public function wrongAction()
    {
        return $this->render("@OrtofitQuiz/Quiz/wrong.html.twig");
    }
}
