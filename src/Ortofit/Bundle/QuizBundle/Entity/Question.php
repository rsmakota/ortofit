<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Question
 *
 * @package Ortofit\Bundle\QuizBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="questions")
 */
class Question
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
     * @ORM\ManyToOne(targetEntity="Ortofit\Bundle\QuizBundle\Entity\Quiz")
     */
    private $quiz;
    /**
     * @ORM\OneToMany(targetEntity="Variant", mappedBy="type")
     * @ORM\OrderBy({"index" = "ASC"})
     */
    private $variants;

    /**
     * Question constructor.
     */
    public function __construct()
    {
        $this->variants = new ArrayCollection();
    }

    /**
     * @return Variant[]
     */
    public function getVariants()
    {
        return $this->variants;
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
    public function getContent()
    {
        return $this->content;
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
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return Quiz
     */
    public function getQuiz()
    {
        return $this->quiz;
    }

    /**
     * @param Quiz $quiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * @return string
     */
    public static function clazz()
    {
        return get_class();
    }
}