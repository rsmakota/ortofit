<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class SingUpSecurity
 *
 * @package Ortofit\Bundle\SingUpBundle\Security
 */
class SingUpSecurity implements  SecurityInterface
{
    const SECURITY_TOKEN_NAME = 'sing_up_token_name';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var string
     */
    private $token;

    /**
     * SingUpSecurity constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return string
     */
    protected function createToken()
    {
        return md5(time());
    }

    /**
     * @param Request $request
     *
     * @return bool
     * @throws \Exception
     */
    public function validate($request)
    {
        $token = $request->request->get(self::SECURITY_TOKEN_NAME);

        if (!empty($token) &&
            $this->session->has(self::SECURITY_TOKEN_NAME) &&
            ($this->session->get(self::SECURITY_TOKEN_NAME) == $token)
        ) {
            return true;
        }
        $sessionToken = $this->session->get(self::SECURITY_TOKEN_NAME);

        throw new \Exception(sprintf('Token is invalid or empty. Expects <<%s>> but gotten <<%s>>', $sessionToken, $token));
    }

    /**
     * @return void
     */
    public function init()
    {
        $this->token = $this->createToken();
        $this->session->set(self::SECURITY_TOKEN_NAME, $this->token);
    }

    /**
     * @return array
     */
    public function getSecurityContext()
    {
        return [self::SECURITY_TOKEN_NAME => $this->token];
    }
}