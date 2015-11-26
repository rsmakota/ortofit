<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Appointment;


/**
 * Class LoadAppointmentData
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadAppointmentData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $office = $this->getReference('office:kirova');
        $appointment = new Appointment();
        $appointment->setClient($this->getReference('client:00'));
        $appointment->setDateTime(new \DateTime('+3 day'));
        $appointment->setOffice($office);
        $appointment->setDuration(60);
        $appointment->setDescription('Консультация ортопеда');
        $manager->persist($appointment);
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