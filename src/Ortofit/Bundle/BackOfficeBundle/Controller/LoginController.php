<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * Class LoginController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class LoginController extends  Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $result = [
            'last_username' => $lastUsername,
            'error'         => $error
        ];

        return $this->render('@OrtofitBackOffice/Login/login.html.twig', $result);
    }

    /**
     *
     */
    public function logoutAction()
    {

    }

    /**
     *
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }
}