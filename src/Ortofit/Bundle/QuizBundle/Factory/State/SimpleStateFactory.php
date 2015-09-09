<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Factory\State;

use Ortofit\Bundle\QuizBundle\Flow\State\StateInterface;
use Ortofit\Bundle\QuizBundle\Flow\State\StateQuestion;
use Ortofit\Bundle\QuizBundle\Flow\State\StateResult;
use Ortofit\Bundle\QuizBundle\Flow\State\StateStart;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class SimpleStateFactory
 *
 * @package Ortofit\Bundle\QuizBundle\Factory\State
 */
class SimpleStateFactory implements StateFactoryInterface
{
    /**
     * @var EngineInterface
     */
    private $templateEngine;

    /**
     * SimpleStateFactory constructor.
     *
     * @param EngineInterface $templateEngine
     */
    public function __construct(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param string $type
     * @param object $entityData
     *
     * @return StateInterface
     * @throws \Exception
     */
    public function createState($type, $entityData)
    {
        $method = 'create'.ucfirst($type).'State';
        if (method_exists($this, $method)) {
            return $this->$method($entityData);
        }

        throw new \Exception('The Method '.$method.' isn\'t exist');
    }

    /**
     * @param ParameterBag $entityData
     *
     * @return StateInterface
     */
    protected function createStartState($entityData)
    {
        $state = new StateStart($this->templateEngine);
        $state->setEntityData($entityData);

        return $state;
    }

    /**
     * @param object $entityData
     *
     * @return StateQuestion
     */
    protected function createQuestionState($entityData)
    {
        $state    = new StateQuestion($this->templateEngine);
        $state->setEntityData($entityData);

        return $state;
    }

    /**
     * @param object $entityData
     *
     * @return StateResult
     */
    protected function createResultState($entityData)
    {
        $state = new StateResult($this->templateEngine);
        $state->setEntityData($entityData);

        return $state;
    }

}