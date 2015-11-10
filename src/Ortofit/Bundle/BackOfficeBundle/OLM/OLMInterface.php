<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\OLM;


interface OLMInterface
{
    /**
     * @param $id
     *
     * @return OLMInterface|null
     */
    public function find($id);

    /**
     * @return array
     */
    public function all();
}