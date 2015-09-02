<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Ortofit LLC
 */

namespace Ortofit\Bundle\QuizBundle\Flow\State;

use Ortofit\Bundle\QuizBundle\Entity\Question;
use Ortofit\Bundle\QuizBundle\Entity\Variant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class StateQuestion
 *
 * @package Ortofit\Bundle\QuizBundle\Flow\State
 */
class StateQuestion extends AbstractState
{


    /**
     * @var Question
     */
    protected $question;

    /**
     * @param Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return array
     */
    protected function formatResponseData()
    {
        $variants = [];
        foreach ($this->question->getVariants() as $variant) {
            $variants[] = [
                'name' => $variant->getName(), 'value' => $variant->getId(), 'content' => $variant->getContent()
            ];
        }
        $data = [
            'name'     => $this->question->getName(),
            'index'    => $this->question->getIndex(),
            'content'  => $this->question->getContent(),
            'stateId'  => $this->getId(),
            'position' => $this->question->getPosition(),
            'variants' => $variants
        ];

        return $data;
    }

    /**
     * @return Variant|null
     */
    public function getSelectedVariant()
    {
        foreach ($this->question->getVariants() as $variant) {
            if ($variant->getId() == $this->selectedVariantId) {
                return $variant;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return self::STATE_NAME_QUESTION.'_'.$this->question->getIndex();
    }

    /**
     * @param SessionInterface $session
     * @param Request          $request
     *
     * @return void
     */
    public function process(SessionInterface $session, Request $request)
    {
        if ($request->request->has($this->getId())) {
            $variantId = $request->request->get($this->getId());
            $variants  = $session->get(self::SESSION_PARAM_VARIANTS);
            $variants[$this->question->getId()] = $variantId;
            $session->set(self::SESSION_PARAM_VARIANTS, $variants);
            $session->set($this->getId(), $variantId);
            $this->selectedVariantId = $variantId;
            $this->completed = true;
        }
    }
}