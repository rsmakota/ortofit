<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow;

use Ortofit\Bundle\QuizBundle\Flow\State\StateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class Flow
 *
 * @package Ortofit\Bundle\QuizBundle\Flow
 */
class Flow implements FlowInterface
{
    /**
     * @var StateInterface[]
     */
    private $states = [];
    /**
     * @var StateInterface
     */
    private $currentState;

    /**
     * @param StateInterface[] $states
     */
    public function __construct($states)
    {
        $this->states = $states;
    }

    /**
     * @param SessionInterface $session
     */
    public function fill(SessionInterface $session)
    {
        foreach ($this->states as $state) {
            $state->fill($session);
        }
    }

    /**
     * @param string $stateId
     */
    protected function seekToState($stateId)
    {
        foreach ($this->states as $state) {
            if ($state->getId() == $stateId) {
                $this->currentState = $state;
            }
        }
    }

    /**
     * @param StateInterface $state
     *
     * @return integer
     * @throws \Exception
     */
    private function getStatePosition(StateInterface $state)
    {
        for ($i=0; $i<count($this->states); $i++) {
            if ($state == $this->states[$i]) {
                return $i;
            }
        }
        throw new \Exception('State '.$state->getId(). 'can\'t find in the collection');
    }

    /**
     * @throws \Exception
     */
    protected function nextState()
    {
        $position = $this->getStatePosition($this->currentState);
        if (count($this->states) > $position) {
            $this->currentState = $this->states[($position + 1)];
        }
    }

    /**
     * @throws \Exception
     */
    protected function rewindState()
    {
        $position = $this->getStatePosition($this->currentState) - 1;
        if ($position > -1) {
            $this->currentState = $this->states[$position];
        }
    }

    /**
     * @param SessionInterface $session
     * @param Request          $request
     *
     * @return void
     */
    public function process(SessionInterface $session, Request $request)
    {
        $this->currentState->process($session, $request);
        if ($this->currentState->isCompleted()) {
            $this->nextState();
        }

        $session->set('currentStateId', $this->currentState->getId());
    }

    /**
     * @return string
     */
    public function createResponse()
    {
        return $this->currentState->createResponse();
    }
}