<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\ClientDirection;

/**
 * Class LoadClientSourceData
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadClientDirectionData extends AbstractFixture implements OrderedFixtureInterface
{
    private $sources = [
        'internet' => 'Интернет',
        'bord'     => 'Наружная реклама',
        'friends'  => 'Посоветовали знакомы',
        'return'   => 'Повторно'
    ];
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach($this->sources as $key => $name) {
            $source = new ClientDirection();
            $source->setName($name);
            $manager->persist($source);
            $this->addReference('clientDirection:'.$key, $source);
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