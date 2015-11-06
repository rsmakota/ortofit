<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\EntityManager;

use Ortofit\Bundle\SingUpBundle\Entity\Diagnosis;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class DiagnosisManager
 *
 * @package Ortofit\Bundle\BackOfficeBundle\ObjectManager
 */
class DiagnosisManager extends AbstractManager
{

    /**
     * @return string
     */
    protected function getEntityClassName()
    {
        return Diagnosis::clazz();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'diagnosis_manager';
    }

    /**
     * @param ParameterBag $params
     *
     * @return object
     */
    public function create($params)
    {
        $person = $this->rGet($params->get('personId'));
        $entity = new Diagnosis();
        $entity->setContent($params->get('content'));
        $entity->setPerson($person);
        $this->persist($entity);
    }

    /**
     * @param ParameterBag $params
     *
     * @return boolean
     */
    public function update($params)
    {
        $person = $this->rGet($params->get('personId'));
        $entity = $this->rGet($params->get('id'));
        $entity->setContent($params->get('content'));
        $entity->setPerson($person);
        $this->merge($entity);
    }
}