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
            'А' => ['result'=>'Нормальный свод стопы','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_a.png">'],
            'В' => ['result'=>'Полая стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_b.png">'],
            'С' => ['result'=>'Вальгусная стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_c.png">'],
            'D' => ['result'=>'Уплощенная стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_d.png">'],
            'Е' => ['result'=>'Плоско-вальгусная стопа','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_1_e.png">']
        ],
        'question:second' => [
            'А' => ['result'=>'Вальгусное положение заднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_2_a.png">'],
            'В' => ['result'=>'Нормальное положение заднего отдела стопы','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_2_b.png">'],
            'С' => ['result'=>'Варусное положение заднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_2_c.png">']
        ],
        'question:third' => [
            'А' => ['result'=>'Варус позиция переднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_3_a.png">'],
            'В' => ['result'=>'Норм положение переднего отдела стопы','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_3_b.png">'],
            'С' => ['result'=>'Вальгус позиция переднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_3_c.png">']
        ],
        'question:fourth' => [
            'А' => ['result'=>'Приведение переднего отдела стопы','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_4_a.png">', 'recommendation' => 'Коррекция индивидуальными ортопедическими стельками со специальным  корректирующим клином в переднем отделе стелек и ортопедическая обувь с удлиненным ребром жесткости по внутренней поверхности стопы до уровня большого пальца (“обувь с антиприведением”)'],
            'В' => ['result'=>'','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_4_b.png">'],
            'С' => ['result'=>'','positive'=>true,  'content'=>'Нет моего варианта']
        ],
        'question:fifth' => [
            'А' => ['result'=>'Нормальная ось нижних конечностей (“стройные ноги”)','positive'=>true,  'content'=>'<img src="/bundles/ortofitquiz/img/feet_5_a.png">'],
            'В' => ['result'=>'Варусная ось нижних конечностей (“О-образные ноги”)','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_5_b.png">'],
            'С' => ['result'=>'Вальгусная ось нижних конечностей (“Х-образные ноги”)','positive'=>false, 'content'=>'<img src="/bundles/ortofitquiz/img/feet_5_c.png">']
        ],
        'question:sixth' => [
            '1' => ['result'=>'','positive'=>true, 'content'=>'',],
            '2' => ['result'=>'','positive'=>true, 'content'=>'',],
            '3' => ['result'=>'','positive'=>true, 'content'=>'',],
            '4' => ['result'=>'','positive'=>true, 'content'=>'',],
            '5' => ['result'=>'Выраженный вальгус','positive'=>true, 'content'=>'',],
            '6' => ['result'=>'Выраженный  варус','positive'=>true, 'content'=>'',],
        ],
        'question:seventh' => [
            'А' => ['result'=>'','positive'=>true, 'content'=>'не испытываю', 'recommendation' => ''],
            'В' => ['result'=>'Болевой синдром','positive'=>false, 'content'=>'болит голова', 'recommendation' => 'Консультация врача-невролога'],
            'С' => ['result'=>'Болевой синдром','positive'=>false, 'content'=>'болит спина', 'recommendation' => 'Консультация врача-невролога'],
            'D' => ['result'=>'Болевой синдром','positive'=>false, 'content'=>'болят ноги', 'recommendation' => 'Индивидуальные ортопедические стельки'],
            'Е' => ['result'=>'Болевой синдром','positive'=>false, 'content'=>'другие боли', 'recommendation' => 'Консультация врача-невролога']
        ],
        'question:eighth' => [
            'А' => ['result'=>'','positive'=>true, 'content'=>'до 2-х лет', 'recommendation' => 'Профилактическая или ортопедическая обувь'],
            'В' => ['result'=>'','positive'=>true, 'content'=>'3-5 лет', 'recommendation' => 'Индивидуальные ортопедические стельки и специальная ортопедическая обувь'],
            'С' => ['result'=>'','positive'=>true, 'content'=>'6-9 лет', 'recommendation' => 'Индивидуальные ортопедические стельки и специальная ортопедическая обувь'],
            'D' => ['result'=>'','positive'=>true, 'content'=>'10-16 лет', 'recommendation' => 'Индивидуальные ортопедические стельки и специальная ортопедическая обувь'],
            'Е' => ['result'=>'','positive'=>true, 'content'=>'17-19 лет', 'recommendation' => 'Индивидуальные ортопедические стельки'],
            'F' => ['result'=>'','positive'=>true, 'content'=>'взрослый', 'recommendation' => 'Индивидуальные ортопедические стельки']
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
                $variant->setResult($value['result']);
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