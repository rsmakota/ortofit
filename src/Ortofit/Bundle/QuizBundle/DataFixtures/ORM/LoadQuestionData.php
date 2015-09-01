<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */
namespace Ortofit\Bundle\QuizBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\QuizBundle\Entity\Question;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;

/**
 * Class LoadQuestionData
 *
 * @package Ortofit\Bundle\QuizBundle\DataFixtures\ORM
 */
class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface
{
    private $loadData = [
        [
            'name'      => 'Ориентировочно проверяем состояние сводов стопы',
            'content'   => 'Нанесите на подошвенную поверхность стоп жирный крем и наступите на лист бумаги.<br> Оцените полученный отпечаток. На какой из приведенных ниже рисунков он похож?',
            'index'     => 1,
            'reference' => 'question:first',
            'position'  => Question::VARIANT_POSITION_HORIZON
        ],
        [
            'name'      => 'Проверяем положение заднего отдела стоп',
            'content'   => 'Посмотрите на стопы ребенка со спины. <br> Для взрослых - можно попросить, кого-то cфотографировать задний отдел Ваших стоп.',
            'index'     => 2,
            'reference' => 'question:second',
            'position'  => Question::VARIANT_POSITION_HORIZON
        ],
        [
            'name'      => 'Проверяем позицию переднего отдела стопы',
            'content'   => 'Посмотрите на стопы ребенка спереди. <br> Для взрослых можно увидеть отражение переднего отдела стоп в зеркале. <br> На какой рисунок больше похоже?',
            'index'     => 3,
            'reference' => 'question:third',
            'position'  => Question::VARIANT_POSITION_VERTICAL
        ],
        [
            'name'      => 'Проверяем наличие приведения переднего отдела стопы',
            'content'   => 'По полученному отпечатку стопы и посмотрев сверху на стопу отметьте образует ли угол продольная ось стопы. Имеет ли место приведение пальцев во внутрь или наружу?  На какой рисунок больше похоже?',
            'index'     => 4,
            'reference' => 'question:fourth',
            'position'  => Question::VARIANT_POSITION_HORIZON
        ],
        [
            'name'      => 'Проверяем положение коленных суставов относительно вертикальной оси',
            'content'   => 'Посмотрите на положение коленных суставов, на какой рисунок больше похоже?',
            'index'     => 5,
            'reference' => 'question:fifth',
            'position'  => Question::VARIANT_POSITION_HORIZON
        ],
        [
            'name'      => 'Проверяем как изнашивается обувь',
            'content'   => 'Посмотрите на подошву изношенной обуви. Отметьте где наиболее стирается подошва.  Каким зонам соответствует рисунок стирания? <br> <img src="/bundles/ortofitquiz/img/feet_6.png">',
            'index'     => 6,
            'reference' => 'question:sixth',
            'position'  => Question::VARIANT_POSITION_HORIZON
        ],
        [
            'name'      => 'Испытываете ли вы боли?',
            'content'   => '',
            'index'     => 7,
            'reference' => 'question:seventh',
            'position'  => Question::VARIANT_POSITION_VERTICAL
        ],
        [
            'name'      => 'Укажите возраст',
            'content'   => '',
            'index'     => 8,
            'reference' => 'question:eighth',
            'position'  => Question::VARIANT_POSITION_VERTICAL
        ],

    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var Quiz $quiz */
        $quiz = $this->getReference('quiz:feet');
        foreach ($this->loadData as $data) {
            $question = new Question();
            $question->setQuiz($quiz);
            $question->setName($data['name']);
            $question->setIndex($data['index']);
            $question->setContent($data['content']);
            $question->setPosition($data['position']);

            $manager->persist($question);
            $this->setReference($data['reference'], $question);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 110;
    }
}