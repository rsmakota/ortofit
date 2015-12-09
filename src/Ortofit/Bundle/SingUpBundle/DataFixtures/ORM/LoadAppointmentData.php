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
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Entity\Office;
use Ortofit\Bundle\SingUpBundle\Entity\Service;


/**
 * Class LoadAppointmentData
 *
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadAppointmentData extends AbstractFixture implements OrderedFixtureInterface
{

    private $services = [
        'consult',
        'correction',
        'insoles',
        'massage',
    ];
    private $offices = ['office:kirova', 'office:center'];

    /**
     * @param string  $officeAlias
     * @param integer $day
     * @param integer $hour
     *
     * @return Appointment
     */
    public function create($officeAlias, $day, $hour)
    {

        if ($hour < 10) {
            $hour = '0'.$hour;
        }
        /** @var Client $client */
        $client       = $this->getReference('client:00');
        /** @var Office $office */
        $office       = $this->getReference($officeAlias);
        $serviceAlias = $this->services[rand(0, 3)];
        $description  = 'Description: '.$serviceAlias;
        /** @var Service $service */
        $service      = $this->getReference('service:'.$serviceAlias);

        $date         = new \DateTime($day.' day');
        $date         = new \DateTime($date->format('Y-m-d').' '.$hour.":00:00");
        $appointment  = new Appointment();
        $appointment->setClient($client);
        $appointment->setDateTime($date);
        $appointment->setOffice($office);
        $appointment->setDuration(60);
        $appointment->setDescription($description);
        $appointment->setService($service);

        return $appointment;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $client = $this->getReference('client:00');
        foreach ($this->offices as $officeAlias) {
            for ($d = -15; $d < 15; $d++) {
                for ($h = 8; $h < 19; $h++) {
                    $appointment = $this->create($officeAlias, $d, $h);
                    $manager->persist($appointment);
                }
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
        return 140;
    }
}