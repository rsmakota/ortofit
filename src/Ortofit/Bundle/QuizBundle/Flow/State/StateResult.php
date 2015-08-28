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
        // TODO: Implement formatResponseData() method.
    }

    /**
     * @param SessionInterface $session
     * @param Request          $request
     *
     * @return void
     */
    public function process(SessionInterface $session, Request $request)
    {
        // TODO: Implement process() method.
    }

    /**
     * @return string
     */
    public function getId()
    {
        return self::STATE_NAME_RESULT;
    }
}