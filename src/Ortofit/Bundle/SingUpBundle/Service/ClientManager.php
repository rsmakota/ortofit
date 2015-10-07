<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Service;

use Doctrine\ORM\EntityManager;
use Ortofit\Bundle\SingUpBundle\Entity\Client;
use Ortofit\Bundle\SingUpBundle\Entity\Country;

/**
 * Class ClientManager
 *
 * @package Ortofit\Bundle\SingUpBundle\Service
 */
class ClientManager
{
    /**
     * @var EntityManager
     */
    private $enManager;

    public function __construct(EntityManager $eManager)
    {
        $this->enManager = $eManager;
    }

    /**
     * @param string  $msisdn
     * @param Country $country
     *
     * @return Client
     * @throws \Exception
     */
    public function createClient($msisdn, $country)
    {
        if (!$country->validateMsisdn($msisdn)) {
            throw new \Exception('The telephone number is invalid. ');
        }

        $client = new Client();
        $client->setMsisdn($msisdn);
        $client->setCountry($country);

        $this->enManager->persist($client);
        $this->enManager->flush();

        return $client;
    }
}