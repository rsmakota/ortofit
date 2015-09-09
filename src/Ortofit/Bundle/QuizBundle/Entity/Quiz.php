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
     * @ORM\OneToMany(targetEntity="Ortofit\Bundle\QuizBundle\Entity\Question", mappedBy="quiz")
     * @ORM\OrderBy({"index" = "ASC"})
     */
    private $questions;
    /**
     * @ORM\Column(type="string", name="start_template")
     */
    private $startTemplate;
    /**
     * @ORM\Column(type="string", name="result_template")
     */
    private $resultTemplate;
    /**
     * @ORM\Column(type="string")
     */
    private $resultManagerId;

    /**
     * Quiz constructor.
     */
    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getResultManagerId()
    {
        return $this->resultManagerId;
    }

    /**
     * @param string $resultManagerId
     */
    public function setResultManager($resultManagerId)
    {
        $this->resultManagerId = $resultManagerId;
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
    public function getStartTemplate()
    {
        return $this->startTemplate;
    }

    /**
     * @param string $startTemplate
     */
    public function setStartTemplate($startTemplate)
    {
        $this->startTemplate = $startTemplate;
    }

    /**
     * @return string
     */
    public function getResultTemplate()
    {
        return $this->resultTemplate;
    }

    /**
     * @param string $resultTemplate
     */
    public function setResultTemplate($resultTemplate)
    {
        $this->resultTemplate = $resultTemplate;
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }

}