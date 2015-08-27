<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */
namespace Ortofit\Bundle\QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class QuizController
 *
 * @package Ortofit\Bundle\QuizBundle\Controller
 */
class QuizController extends Controller
{
    /**
     * @param Request $request
     * @param integer $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $id)
    {
        $session = $request->getSession();
        //$session->set('a', 'dfghjkl');
        $session->set('b', 'dfghjkl');
        dump($session); exit;
        return $this->render('OrtofitQuizBundle:Quiz:index.html.twig', array('name' => $name));
    }
}
