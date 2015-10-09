<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Country;

/**
 * Class LoadCountyData
 *
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadCountyData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $county = new Country();
        $county->setName('Ukraine');
        $county->setIso2('ua');
        $county->setPrefix('380');
        $county->setPattern('^380[3-9]{1}[0-9]{8}$');

        $manager->persist($county);
        $manager->flush();

        $this->addReference('country:ua', $county);
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