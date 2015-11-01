<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\FamilyStatus;

/**
 * Class LoadFamilyStatusData
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadFamilyStatusData extends AbstractFixture implements OrderedFixtureInterface
{
    private $generalStatuses  = ['son', 'daughter', 'husband', 'wife'];
    private $extendedStatuses = ['mother', 'father', 'nephew', 'niece'];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach($this->generalStatuses as $name) {
            $entity = new FamilyStatus();
            $entity->setName($name);
            $entity->setGeneral(true);
            $manager->persist($entity);
            $this->addReference('status:'.$name, $entity);
        }

        foreach($this->extendedStatuses as $name) {
            $entity = new FamilyStatus();
            $entity->setName($name);
            $entity->setGeneral(false);
            $manager->persist($entity);
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