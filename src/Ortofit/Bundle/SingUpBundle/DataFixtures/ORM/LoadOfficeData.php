<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Office;

/**
 * Class LoadCountyData
 *
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadOfficeData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //////////////////////////////////////////////
        $city = $this->getReference('city:dp');
        $office = new Office();
        $office->setName('Kirova 102');
        $office->setCity($city);
        $this->addReference('office:kirova', $office);
        $manager->persist($office);
        ///////////////////////////////////////////////
        $office = new Office();
        $office->setName('Center 6');
        $office->setCity($city);
        $this->addReference('office:center', $office);
        $manager->persist($office);
        //////////////////////////////////////////////
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