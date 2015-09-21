<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author    Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\QuizBundle\Result;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Ortofit\Bundle\QuizBundle\Entity\Quiz;
use Ortofit\Bundle\QuizBundle\Entity\Result;
use Ortofit\Bundle\QuizBundle\Entity\Variant;

/**
 * Class DiagnosticManager
 *
 * @package Ortofit\Bundle\QuizBundle\Diagnostic
 */
class ResultManager implements ResultManagerInterface
{
    private $entityManager;

    /**
     * @var Variant[]
     */
    private $variants;

    /**
     * @var Quiz
     */
    private $quiz;

    /**
     * ResultManager constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return void
     */
    public function saveResult()
    {
        $result = new Result();
        $result->setQuiz($this->quiz);
        $result->setVariants(new ArrayCollection($this->variants));

        $this->entityManager->persist($result);
        $this->entityManager->flush();
    }

    /**
     * @param Quiz $quiz
     */
    public function setQuiz($quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * @param array $variants
     */
    public function loadVariants($variants)
    {
        foreach ($variants as $variantId) {
            $this->variants[] = $this->entityManager->getRepository(Variant::clazz())->find($variantId);
        }
    }

    /**
     * @return boolean
     */
    private function isPositive()
    {
        foreach ($this->variants as $variant) {
            if (!$variant->getPositive()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    private function createOutcome()
    {
        $result = [];
        foreach ($this->variants as $variant) {
            $outcome = $variant->getOutcome();
            if (!empty($outcome)) {
                $result[] = ucfirst($outcome);
            }
        }

        return implode('. ', $result);
    }

    /**
     * @return mixed|string
     */
    private function createRecommendation()
    {
        foreach ($this->variants as $variant) {
            if (null != $variant->getRecommendation()) {
                return ucfirst($variant->getRecommendation());
            }
        }

        return '';
    }

    /**
     * @return ResultInterface
     */
    public function createDiagnosis()
    {
        $result = new \Ortofit\Bundle\QuizBundle\Result\Result(
            $this->createOutcome(),
            $this->createRecommendation(),
            $this->isPositive()
        );

        return $result;
    }
}