<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class EntityController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class EntityController extends Controller
{
    /**
     * @return array
     */
    public function getEntityNameList()
    {
        $managers = $this->get('ortofit_back_office.entity_manager_olm')->all();
        $data = [];
        foreach($managers as $manager) {
            $name = explode('_', $manager->getName());
            $data[] = $name[0];
        }

        return $data;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $entityList = $this->getEntityNameList();
        //dump($entityList);
        return $this->render('@OrtofitBackOffice/Entity/index.html.twig', ['entityList' => $entityList]);
    }
}