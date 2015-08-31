<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow\State;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Interface StateInterfacel
 *
 * @package Ortofit\Bundle\QuizBundle\Flow\State
 */
interface StateInterface
{
    /**
     * @param SessionInterface $session
     * @param Request          $request
     *
     * @return void
     */
    public function process(SessionInterface $session, Request $request);

    /**
     * @return string
     */
    public function createResponse();

    /**
     * @return string
     */
    public function getId();

    /**
     * @return boolean
     */
    public function isCompleted();

    /**
     * @param SessionInterface $session
     *
     * @return void
     */
    public function fill(SessionInterface $session);

    /**
     * @return mixed
     */
    public function getSelectedVariant();

    /**
     * @return boolean
     */
    public function isResultState();
}