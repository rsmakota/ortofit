<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class Variant
 *
 * @package Ortofit\Bundle\QuizBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="variants")
 */
class Variant
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
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $index;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @ORM\Column(type="boolean")
     */
    private $positive;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $outcome;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $recommendation;

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
     * @return integer
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param integer $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }
    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getPositive()
    {
        return $this->positive;
    }

    /**
     * @param mixed $positive
     */
    public function setPositive($positive)
    {
        $this->positive = $positive;
    }

    /**
     * @return mixed
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * @param mixed $outcome
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;
    }

    /**
     * @return mixed
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * @param mixed $recommendation
     */
    public function setRecommendation($recommendation)
    {
        $this->recommendation = $recommendation;
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
}