<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Application
 *
 * @package Ortofit\Bundle\SingUpBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="applications")
 */
class Application implements EntityInterface
{
    const TYPE_VISIT = 'visit';

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * @var Country
     */
    private $country;

    /**
     * Container Id
     * @ORM\Column(type="string", name="flow_service_name")
     */
    private $flowServiceName;

    /**
     * @ORM\Column(type="json_array")
     */
    private $config;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
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
     * @return string
     */
    public function getFlowServiceName()
    {
        return $this->flowServiceName;
    }

    /**
     * @param string $flowServiceName
     */
    public function setFlowServiceName($flowServiceName)
    {
        $this->flowServiceName = $flowServiceName;
    }

    /**
     * @return string
     */
    public function getNotifySubject()
    {
        return $this->config['notify']['subject'];
    }

    /**
     * @return string
     */
    public function getNotifyBody()
    {
        return $this->config['notify']['body'];
    }

    /**
     * @return string
     */
    public function getTemplateName()
    {
        return $this->config['template']['name'];
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
            'id'              => $this->id,
            'name'            => $this->name,
            'created'         => $this->created->format('Y-m-d H:i:s'),
            'type'            => $this->type,
            'countryId'       => $this->getCountry()->getId(),
            'flowServiceName' => $this->flowServiceName,
            'config'          => $this->config
        ];
    }
}