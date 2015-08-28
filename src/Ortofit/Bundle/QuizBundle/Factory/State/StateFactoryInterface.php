<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */
namespace Ortofit\Bundle\QuizBundle\Factory\State;

use Ortofit\Bundle\QuizBundle\Flow\State\StateInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Interface StateFactoryInterface
 *
 * @package Ortofit\Bundle\QuizBundle\Factory\State
 */
interface StateFactoryInterface
{
    const STATE_TYPE_START    = 'start';
    const STATE_TYPE_RESULT   = 'result';
    const STATE_TYPE_QUESTION = 'question';

    /**
     * @param string       $type
     * @param ParameterBag $bag
     *
     * @return StateInterface
     */
    public function createState($type, $bag);
}