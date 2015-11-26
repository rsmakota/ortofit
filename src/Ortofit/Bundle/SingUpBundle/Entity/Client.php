<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Client - This is a registered person (contact)
 *
 * @package Ortofit\Bundle\SingUpBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Client implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $msisdn;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;
    /**
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;
    /**
     * @ORM\ManyToOne(targetEntity="ClientDirection")
     * @ORM\JoinColumn(name="client_direction_id", referencedColumnName="id")
     */
    private $clientDirection;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return ClientDirection
     */
    public function getClientDirection()
    {
        return $this->clientDirection;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param ClientDirection $clientDirection
     */
    public function setClientDirection($clientDirection)
    {
        $this->clientDirection = $clientDirection;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param string $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return string
     */
    static public function clazz()
    {
        return get_class();
    }

    /**
     * @return array
     */
    public function getData()
    {
        return [
            'id'                => $this->id,
            'msisdn'            => $this->msisdn,
            'created'           => $this->created->format('Y-m-d H:i:s'),
            'clientDirectionId' => $this->getClientDirection()->getId(),
            'countryId'         => $this->getCountry()->getId()
        ];
    }
}