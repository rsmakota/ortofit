<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Application;

use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Interface ApplicationFlowInterface
 *
 * @package Ortofit\Bundle\SingUpBundle\Application
 */
interface ApplicationFlowInterface
{
    const SESSION_APP_ID    = 'application_id';
    const SESSION_APP_TOKEN = 'application_token';

    const RESPONSE_SUCCESS = 'success';
    const RESPONSE_FAIL    = 'fail';
    /**
     * @return void
     */
    public function createForm();

    /**
     * @param SessionInterface $session
     */
    public function setSession(SessionInterface $session);

    /**
     * @return string
     */
    public function getResponse();

    /**
     * @param Application $application
     */
    public function setApplication($application);

    /**
     * @param string       $method
     * @param ParameterBag $bag
     *
     * @return void
     */
    public function action($method, ParameterBag $bag);
}