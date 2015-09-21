<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\QuizBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;

/**
 * Class LoadQuizData
 *
 * @package Ortofit\Bundle\QuizBundle\DataFixtures\ORM
 */
class LoadQuizData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $quiz = new Quiz();
        $quiz->setName('Диагностический тест состояния стоп');
        $quiz->setDescription('Уважаемые посетители сайта “Ортофит”, для Вашего удобства мы подготовили  диагностический тест состояния стоп который можно пройти в онлайн-режиме.');
        $quiz->setStartTemplate('OrtofitQuizBundle:Quiz:start.html.twig');
        $quiz->setResultTemplate('OrtofitQuizBundle:Quiz:result.html.twig');
        $quiz->setResultManager('ortofit_quiz.result_manager');

        $this->addReference('quiz:feet', $quiz);

        $manager->persist($quiz);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 100;
    }
}