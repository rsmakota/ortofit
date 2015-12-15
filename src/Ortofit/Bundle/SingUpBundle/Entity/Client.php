<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
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
    const GENDER_MALE   = "male";
    const GENDER_FEMALE = "female";

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
     * @ORM\OneToMany(targetEntity="Person", mappedBy="client")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private $persons;

    /**
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->persons = new ArrayCollection();
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
     * @return mixed
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     * @param mixed $persons
     */
    public function setPersons($persons)
    {
        $this->persons = $persons;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
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
            'countryId'         => $this->getCountry()->getId(),
            'gender'            => $this->gender
        ];
    }
}