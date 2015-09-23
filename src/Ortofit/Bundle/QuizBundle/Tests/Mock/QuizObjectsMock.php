<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Tests\Mock;


use Ortofit\Bundle\QuizBundle\Entity\Question;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Ortofit\Bundle\QuizBundle\Entity\Variant;

/**
 * Class QuizMock
 *
 * @package Ortofit\Bundle\QuizBundle\Tests\Mock
 */
trait QuizObjectsMock
{
    /**
     * @return Quiz
     */
    protected function getQuiz()
    {
        $quiz = new Quiz();
        $quiz->setName('Диагностический тест состояния стоп');
        $quiz->setDescription('Уважаемые посетители сайта “Ортофит”, для Вашего удобства мы подготовили  диагностический тест состояния стоп который можно пройти в онлайн-режиме.');
        $quiz->setStartTemplate('OrtofitQuizBundle:Quiz:start.html.twig');
        $quiz->setResultTemplate('OrtofitQuizBundle:Quiz:result.html.twig');
        $quiz->setResultManager('ortofit_quiz.diagnostic_manager');

        return $quiz;
    }

    /**
     * @return Question
     */
    protected function getQuestion()
    {
        $question = new Question();
        $question->setTemplate('OrtofitQuizBundle:Quiz:question.html.twig');
        $question->setContent('QuestionContent');
        $question->setId(1);
        $question->setIndex(1);
        $question->setName('QuestionName');
        $question->setPosition(Question::VARIANT_POSITION_HORIZON);

        return $question;
    }

    /**
     * @return Variant
     */
    protected function getVariant()
    {
        $variant = new Variant();
        $variant->setName('VariantName');
        $variant->setIndex(1);
        $variant->setId(1);
        $variant->setResult('VariantOutcome');
        $variant->setContent('VariantContent');
        $variant->setRecommendation('VariantRecommendation');

        return $variant;
    }
}