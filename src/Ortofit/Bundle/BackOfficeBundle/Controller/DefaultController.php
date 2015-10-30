<?php

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return array
     */
    public function indexAction()
    {
        return $this->render('@OrtofitBackOffice/Default/index.html.twig', []);
    }
}
