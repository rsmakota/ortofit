<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow\State;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class StateResult
 *
 * @package Ortofit\Bundle\QuizBundle\Flow\State
 */
class StateResult extends AbstractState
{
    protected $resultManager;
    /**
     * @return array
     */
    protected function formatResponseData()
    {
        return [
            'stateId' => $this->getId(),
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
}