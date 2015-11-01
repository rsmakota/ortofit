<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\ClientSource;

/**
 * Class LoadClientSourceData
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadClientSourceData extends AbstractFixture implements OrderedFixtureInterface
{
    private $sourses = ['Internet', 'Bord', 'Friends', 'Word Of Mouth'];
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach($this->sourses as $name) {
            $source = new ClientSource();
            $source->setName($name);
            $manager->persist($source);
        }
        $manager->flush();
        ;
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