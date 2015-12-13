<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Diagnosis
 * @package Ortofit\Bundle\SingUpBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="diagnoses")
 */
class Diagnosis implements EntityInterface
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="diagnoses")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $person;

    /**
     * Diagnosis constructor.
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
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
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
            'id'       => $this->id,
            'created'  => $this->created->format('Y-m-d H:i:s'),
            'content'  => $this->content,
            'personId' => $this->getPerson()->getId()
        ];
    }
}