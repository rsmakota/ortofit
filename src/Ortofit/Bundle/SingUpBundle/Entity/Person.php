<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Person
 *
 * @package Ortofit\Bundle\SingUpBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="persons")
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $name;

    private $age;

    private $familyId; // father, mother, daughter, son, husband, wife

    private $created;

    private $diagnosisId; //


    /**
     * @return string
     */
    static public function clazz()
    {
        return get_class();
    }

}