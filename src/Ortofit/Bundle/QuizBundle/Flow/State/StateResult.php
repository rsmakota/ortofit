<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow\State;

use Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticInterface;
use Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticResultInterface;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class StateResult
 *
 * @package Ortofit\Bundle\QuizBundle\Flow\State
 */
class StateResult extends AbstractState
{
    const SESSION_PARAM_RESULT_SAVED = 'result_saved';
    /**
     * @var Quiz
     */
    protected $quiz;

    /**
     * @var DiagnosticInterface
     */
    protected $resultManager;

    /**
     * @var DiagnosticResultInterface
     */
    protected $result;

    /**
     * @return Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param Quiz $quiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * @param DiagnosticInterface $resultManager
     */
    public function setResultManager($resultManager)
    {
        $this->resultManager = $resultManager;
    }

    /**
     * @return array
     */
    protected function formatResponseData()
    {
        return [
            'stateId' => $this->getId(),
            'result'  => $this->result
        ];
    }

    /**
     * @param SessionInterface $session
     * @param Request          $request
     *
     * @return void
     */
    public function process(SessionInterface $session, Request $request)
    {
        $variants = $session->get(self::SESSION_PARAM_VARIANTS);
        $this->resultManager->loadVariants($variants);
        $this->resultManager->setQuiz($this->quiz);
        $this->result = $this->resultManager->createDiagnosis();
        if (!$session->has(self::SESSION_PARAM_RESULT_SAVED)) {
            $session->set(self::SESSION_PARAM_RESULT_SAVED, true);
            $this->resultManager->saveResult();
        }
        if ($request->request->has($this->getId())) {
            $session->clear();
            $this->completed = true;
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return self::STATE_NAME_RESULT;
    }

    /**
     * @return boolean
     */
    public function isResultState()
    {
        return true;
    }
}