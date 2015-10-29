<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Application;

use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Symfony\Component\HttpFoundation\ParameterBag;

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
     * @param array $params
     *
     * @return mixed
     */
    public function createForm($params = []);

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
    public function process($method, ParameterBag $bag);
}