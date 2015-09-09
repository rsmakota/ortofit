<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Mock;


use Symfony\Component\HttpFoundation\Request;

trait RequestMock
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function mockRequest()
    {
        return $this->getMockBuilder('Symfony\Component\HttpFoundation\Request')->getMock();
    }

    /**
     * @param array $params
     *
     * @return Request
     */
    public function getRequest(array $params)
    {
        $request = new Request();
        $request->request->add($params);

        return $request;
    }
}