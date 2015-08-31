<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow\State;

use Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticInterface;
use Ortofit\Bundle\QuizBundle\Diagnostic\DiagnosticResultInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class StateResult
 *
 * @package Ortofit\Bundle\QuizBundle\Flow\State
 */
class StateResult extends AbstractState
{
    /**
     * @var DiagnosticInterface
     */
    protected $resultManager;

    /**
     * @var array
     */
    protected $variants = [];

    /**
     * @var DiagnosticResultInterface
     */
    protected $result;

    /**
     * @param DiagnosticInterface $resultManager
     */
    public function setResultManager($resultManager)
    {
        $this->resultManager = $resultManager;
    }

    /**
     * @param array $variants
     */
    public function setVariants(array $variants)
    {
        $this->variants = $variants;
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
        $this->resultManager->loadVariants($this->variants);
        $this->result = $this->resultManager->createDiagnosis();

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