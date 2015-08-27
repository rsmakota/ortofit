<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Class Quiz
 *
 * @package Ortofit\Bundle\QuizBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="quizzes")
 */
class Quiz
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
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="type")
     * @ORM\OrderBy({"index" = "ASC"})
     */
    private $questions;

    /**
     * Quiz constructor.
     */
    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }

}