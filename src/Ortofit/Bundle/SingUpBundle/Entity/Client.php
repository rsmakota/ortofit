<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;

/**
 * Class Client
 * @package Ortofit\Bundle\SingUpBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="clients")
 */
class Client
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
     * @ORM\Column(type="datetime")
     */
    private $created;

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
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }


}