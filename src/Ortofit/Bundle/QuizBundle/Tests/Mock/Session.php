<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Mock;


trait Session
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockSession()
    {
        return $this->getMockBuilder('Symfony\Component\HttpFoundation\Session\SessionInterface')->getMock();
    }
}