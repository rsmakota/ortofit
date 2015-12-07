<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Appointment
 *
 * @package Ortofit\Bundle\SingUpBundle\Entity
 *
 * @ORM\Entity(repositoryClass="Ortofit\Bundle\SingUpBundle\ORM\AppointmentRepository")
 * @ORM\Table(name="appointments")
 */
class Appointment implements EntityInterface
{
    const STATE_NEW      = 1;
    const STATE_NOT_CAME = 2;
    const STATE_SUCCESS  = 3;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="Office")
     * @ORM\JoinColumn(name="office_id", referencedColumnName="id")
     */
    private $office;

    /**
     * @ORM\Column(type="string")
     */
    private $description = '';

    /**
     * This is time duration in minutes
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $service;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
        $this->state = self::STATE_NEW;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param integer $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * @param Office $office
     */
    public function setOffice($office)
    {
        $this->office = $office;
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
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param integer $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        $end = clone $this->dateTime;
        $end->modify('+'.$this->duration.' min');

        return $end;
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
            'id'          => $this->id,
            'created'     => $this->created->format('Y-m-d H:i:s'),
            'dateTime'    => $this->dateTime->format('Y-m-d H:i:s'),
            'clientId'    => $this->getClient()->getId(),
            'state'       => $this->state,
            'office_id'   => $this->getOffice()->getId(),
            'description' => $this->description,
            'duration'    => $this->duration,
            'service_id'  => $this->getService()->getId()
        ];
    }

    /**
     * @return array
     */
    public function getCalendarData()
    {
        return [
            'id'              => $this->id,
            'title'           => $this->description,
            'start'           => $this->dateTime->format('c'),
            'end'             => $this->getEndDate()->format('c'),
            'backgroundColor' => $this->getService()->getColor(),
            'borderColor'     => $this->getService()->getColor(),
        ];
    }
}