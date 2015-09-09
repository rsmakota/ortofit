<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Mock;


trait TemplateEngine
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockTemplateEngine()
    {
        $templateEngine = $this->getMockBuilder('Symfony\Component\Templating\EngineInterface')->getMock();
        $templateEngine->expects($this->any())->method('render')->will($this->returnValue('rendered'));

        return $templateEngine;
    }
}