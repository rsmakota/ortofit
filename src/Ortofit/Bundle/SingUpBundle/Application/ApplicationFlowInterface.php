<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Application;

use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Interface ApplicationFlowInterface
 *
 * @package Ortofit\Bundle\SingUpBundle\Application
 */
interface ApplicationFlowInterface
{
    const SESSION_APPLICATION_ID    = 'application_id';
    const SESSION_APPLICATION_TOKEN = 'application_token';
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
}