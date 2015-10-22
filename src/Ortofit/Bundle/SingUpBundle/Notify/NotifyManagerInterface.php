<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Notify;

/**
 * Interface NotifyManagerInterface
 *
 * @package Ortofit\Bundle\SingUpBundle\Notify
 */
interface NotifyManagerInterface
{
    /**
     * @param string $subject
     * @param string $body
     *
     * @return mixed
     */
    public function send($subject, $body);
}