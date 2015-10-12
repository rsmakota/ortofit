<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author    Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Service;

use Doctrine\ORM\EntityManager;
use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Ortofit\Bundle\SingUpBundle\Entity\Order;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;


/**
 * Class ApplicationManager
 *
 * @package Ortofit\Bundle\SingUpBundle\Service
 */
class OrderManager extends AbstractManager
{
    /**
     * @var ClientManager
     */
    private $clientManager;

    /**
     * @param EntityManager $eManager
     * @param ClientManager $clientManager
     */
    public function __construct(EntityManager $eManager, ClientManager $clientManager)
    {
        parent::__construct($eManager);
        $this->clientManager = $clientManager;
    }

    /**
     * @param ClientManager $clientManager
     */
    public function setClientManager($clientManager)
    {
        $this->clientManager = $clientManager;
    }

    private function getClient(ParameterBag $bag)
    {
        $msisdn = $bag->get(self::PARAM_MSISDN);
        $client = $this->clientManager->findByMsisdn($msisdn);
        if ($client) {
            return $client;
        }
        /** @var Application $app */
        $app = $bag->get(self::PARAM_APP);

        return $this->clientManager->create(new ParameterBag([
            self::PARAM_MSISDN  => $msisdn,
            self::PARAM_COUNTRY => $app->getCountry()]));
    }

    /**
     * @param ParameterBag $bag
     *
     * @return Order
     */
    public function create($bag)
    {
        $entity = new Order();
        $entity->setApplication($bag->get(self::PARAM_APP));
        $entity->setClient($this->getClient($bag));

        $this->enManager->persist($entity);
        $this->enManager->flush();

        return $entity;
    }
}