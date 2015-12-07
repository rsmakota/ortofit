<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Service;

/**
 * Class LoadServiceData
 *
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadServiceData extends AbstractFixture implements OrderedFixtureInterface
{

    private $data = [
        'Консультация'        => ['alias' => 'consult',    'color' => '#0073b7'],
        'Коррекция'           => ['alias' => 'correction', 'color' => '#f39c12'],
        'Изготовление стелек' => ['alias' => 'insoles',    'color' => '#00c0ef'],
        'Массаж'              => ['alias' => 'massage',    'color' => '#00a65a'],
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->data as $name => $data) {
            $entity = new Service();
            $entity->setName($name);
            $entity->setColor($data['color']);
            $manager->persist($entity);
            $this->setReference('service:'.$data['alias'], $entity);
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
        return 100;
    }
}