<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow\State;

use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class StateStart
 *
 * @package Ortofit\Bundle\QuizBundle\Flow\State
 */
class StateStart extends AbstractState
{
    /**
     * @var Quiz
     */
    protected $quiz;

    /**
     * @return array
     */
    protected function formatResponseData()
    {
        return [
            'name'    => $this->quiz->getName(),
            'content' => $this->quiz->getDescription(),
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
            $this->completed = true;
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return self::STATE_NAME_START;
    }

    protected function getTemplate()
    {
        return $this->quiz->getStartTemplate();
    }

    /**
     * @param object $entityData
     *
     * @return mixed
     */
    public function setEntityData($entityData)
    {
        $this->quiz = $entityData;
    }
}