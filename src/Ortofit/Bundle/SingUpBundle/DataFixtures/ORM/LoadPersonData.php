<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Person;

class LoadPersonData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $son = new Person();
        $son->setName('Максим');
        $son->setAge(6);
        $son->setFamilyStatus($this->getReference('status:son'));
        $manager->persist($son);
        $this->setReference('person:son', $son);

        $daughter = new Person();
        $daughter->setName('Катя');
        $daughter->setAge(10);
        $daughter->setFamilyStatus($this->getReference('status:daughter'));
        $manager->persist($daughter);
        $this->setReference('person:daughter', $daughter);

        $husband = new Person();
        $husband->setName('Катя');
        $husband->setAge(10);
        $husband->setFamilyStatus($this->getReference('status:husband'));
        $manager->persist($daughter);
        $this->setReference('person:husband', $husband);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 140;
    }
}