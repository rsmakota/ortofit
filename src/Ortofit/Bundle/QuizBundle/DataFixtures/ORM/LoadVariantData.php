<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\QuizBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\QuizBundle\Entity\Question;
use Ortofit\Bundle\QuizBundle\Entity\Variant;

/**
 * Class LoadVariantData
 *
 * @package Ortofit\Bundle\QuizBundle\DataFixtures\ORM
 */
class LoadVariantData extends AbstractFixture implements OrderedFixtureInterface
{
    private $loadData = [
        'question:first' => [
            'А' => ['outcome'=>'Нормальный свод стопы','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_a.png">'],
            'В' => ['outcome'=>'Полая стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_b.png">'],
            'С' => ['outcome'=>'Вальгусная стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_c.png">'],
            'D' => ['outcome'=>'Уплощенная стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_d.png">'],
            'Е' => ['outcome'=>'Плоско-вальгусная стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_e.png">']
        ],
        'question:second' => [
            'А' => ['outcome'=>'Вальгусное положение заднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_2_a.png">'],
            'В' => ['outcome'=>'Нормальное положение заднего отдела стопы','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_2_b.png">'],
            'С' => ['outcome'=>'Варусное положение заднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_2_c.png">']
        ],
        'question:third' => [
            'А' => ['outcome'=>'Варус позиция переднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_3_a.png">'],
            'В' => ['outcome'=>'Норм положение переднего отдела стопы','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_3_b.png">'],
            'С' => ['outcome'=>'Вальгус позиция переднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_3_c.png">']
        ],
        'question:fourth' => [
            'А' => ['outcome'=>'Приведение переднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_4_a.png">', 'recommendation' => 'коррекция индивидуальными ортопедическими стельками со специальным  корректирующим клином в переднем отделе стелек и ортопедическая обувь с удлиненным ребром жесткости по внутренней поверхности стопы до уровня большого пальца (“обувь с антиприведением”)'],
            'В' => ['outcome'=>'','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_4_b.png">'],
            'С' => ['outcome'=>'','positive'=>true,  'content'=>'Нет моего варианта']
        ],
        'question:fifth' => [
            'А' => ['outcome'=>'Нормальная ось нижних конечностей (“стройные ноги”)','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_5_a.png">'],
            'В' => ['outcome'=>'Варусная ось нижних конечностей (“О-образные ноги”)','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_5_b.png">'],
            'С' => ['outcome'=>'Вальгусная ось нижних конечностей (“Х-образные ноги”)','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_5_c.png">']
        ],
        'question:sixth' => [
            '1' => ['outcome'=>'','positive'=>true, 'content'=>'',],
            '2' => ['outcome'=>'','positive'=>true, 'content'=>'',],
            '3' => ['outcome'=>'','positive'=>true, 'content'=>'',],
            '4' => ['outcome'=>'','positive'=>true, 'content'=>'',],
            '5' => ['outcome'=>'Выраженный вальгус','positive'=>true, 'content'=>'',],
            '6' => ['outcome'=>'Выраженный  варус','positive'=>true, 'content'=>'',],
        ],
        'question:seventh' => [
            'А' => ['outcome'=>'','positive'=>true, 'content'=>'до 2-х лет', 'recommendation' => 'Профилактическая  или ортопедическая обувь'],
            'В' => ['outcome'=>'','positive'=>true, 'content'=>'3-5 лет', 'recommendation' => 'Индивидуальные ортопедические стельки и специальная ортопедическая обувь'],
            'С' => ['outcome'=>'','positive'=>true, 'content'=>'6-9 лет', 'recommendation' => 'Индивидуальные ортопедические стельки и специальная ортопедическая обувь'],
            'D' => ['outcome'=>'','positive'=>true, 'content'=>'10-16 лет', 'recommendation' => 'Индивидуальные ортопедические стельки и специальная ортопедическая обувь'],
            'Е' => ['outcome'=>'','positive'=>true, 'content'=>'17-19 лет', 'recommendation' => 'Индивидуальные ортопедические стельки'],
            'F' => ['outcome'=>'','positive'=>true, 'content'=>'взрослый', 'recommendation' => 'Индивидуальные ортопедические стельки']
        ],
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var Question $question */
        foreach ($this->loadData as $reference => $data) {
            $question= $this->getReference($reference);
            $i=1;
            foreach ($data as $name => $value) {
                $variant = new Variant();
                $variant->setQuestion($question);
                $variant->setName($name);
                $variant->setIndex($i);
                $variant->setContent($value['content']);
                $variant->setPositive($value['positive']);
                $variant->setOutcome($value['outcome']);
                if (array_key_exists('recommendation', $value)) {
                    $variant->setRecommendation($value['recommendation']);
                }
                $manager->persist($variant);
                $i++;
            }
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
        return 120;
    }
}