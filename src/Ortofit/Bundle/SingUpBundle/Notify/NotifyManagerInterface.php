<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
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
    public function notify($subject, $body);
}