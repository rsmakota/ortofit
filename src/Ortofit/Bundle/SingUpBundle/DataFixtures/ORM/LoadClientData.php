<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Client;

/**
 * Class LoadClientData
 *
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadClientData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $client = new Client();
        $client->setMsisdn('380670000000');
        $client->setName('Гордей');
        $client->setCountry($this->getReference('country:ua'));
        $client->setClientDirection($this->getReference('clientDirection:internet'));
        $client->setGender(Client::GENDER_MALE);
        $manager->persist($client);
        $this->addReference('client:00', $client);

        $client = new Client();
        $client->setMsisdn('380671111111');
        $client->setName('Андрей');
        $client->setCountry($this->getReference('country:ua'));
        $client->setClientDirection($this->getReference('clientDirection:friends'));
        $client->setGender(Client::GENDER_MALE);
        $manager->persist($client);
        $this->addReference('client:01', $client);

        $client = new Client();
        $client->setMsisdn('3806722222222');
        $client->setName('Инна');
        $client->setCountry($this->getReference('country:ua'));
        $client->setClientDirection($this->getReference('clientDirection:return'));
        $client->setGender(Client::GENDER_FEMALE);
        $manager->persist($client);
        $this->addReference('client:02', $client);




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