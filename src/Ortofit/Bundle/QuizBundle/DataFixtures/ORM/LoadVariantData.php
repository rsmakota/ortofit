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
            'А' => '<img src="/bundle/ortofitquiz/img/feet_1_a.png">',
            'В' => '<img src="/bundle/ortofitquiz/img/feet_1_b.png">',
            'С' => '<img src="/bundle/ortofitquiz/img/feet_1_c.png">',
            'D' => '<img src="/bundle/ortofitquiz/img/feet_1_d.png">',
            'Е' => '<img src="/bundle/ortofitquiz/img/feet_1_e.png">'
        ],
        'question:second' => [
            'А' => '<img src="/bundle/ortofitquiz/img/feet_2_a.png">',
            'В' => '<img src="/bundle/ortofitquiz/img/feet_2_b.png">',
            'С' => '<img src="/bundle/ortofitquiz/img/feet_2_c.png">'
        ],
        'question:third' => [
            'А' => '<img src="/bundle/ortofitquiz/img/feet_3_a.png">',
            'В' => '<img src="/bundle/ortofitquiz/img/feet_3_b.png">',
            'С' => '<img src="/bundle/ortofitquiz/img/feet_3_c.png">'
        ],
        'question:fourth' => [
            'А' => '<img src="/bundle/ortofitquiz/img/feet_4_a.png">',
            'В' => '<img src="/bundle/ortofitquiz/img/feet_4_b.png">',
            'С' => 'Нет моего варианта'
        ],
        'question:fifth' => [
            'А' => '<img src="/bundle/ortofitquiz/img/feet_5_a.png">',
            'В' => '<img src="/bundle/ortofitquiz/img/feet_5_b.png">',
            'С' => '<img src="/bundle/ortofitquiz/img/feet_5_c.png">'
        ],
        'question:sixth' => ['1' => '', '2' => '', '3' => '', '4' => '', '5' => '', '6' => ''],
        'question:seventh' => [
            'А' => 'до 2-х лет',
            'В' => '3-5 лет',
            'С' => '6-9 лет',
            'D' => '10-16 лет',
            'Е' => '17-19 лет',
            'F' => 'взрослый'
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
            foreach ($data as $name => $content) {
                $variant = new Variant();
                $variant->setQuestion($question);
                $variant->setName($name);
                $variant->setIndex($i);
                $variant->setContent($content);

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