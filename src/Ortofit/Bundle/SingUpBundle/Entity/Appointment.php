<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Appointment
 *
 * @package Ortofit\Bundle\SingUpBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="appointments")
 */
class Appointment
{
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
    private $time;

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
     * @return string
     */
    static public function clazz()
    {
        return get_class();
    }

}