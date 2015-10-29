<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Security;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface SecurityInterface
 *
 * @package Ortofit\Bundle\SingUpBundle\Security
 */
interface SecurityInterface
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function validate($request);

    /**
     * @return mixed
     */
    public function init();

    /**
     * @return array
     */
    public function getSecurityContext();
}