<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\BackOfficeBundle\Controller;

use Ortofit\Bundle\BackOfficeBundle\EntityManager\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ManageController
 *
 * @package Ortofit\Bundle\BackOfficeBundle\Controller
 */
class ManageController extends Controller
{
    /**
     * @return \Ortofit\Bundle\BackOfficeBundle\OLM\EntityManagerOLM
     */
    private function getOlmManager()
    {
        return $this->get('ortofit_back_office.entity_manager_olm');
    }

    /**
     * @param string $objectName
     *
     * @return EntityManagerInterface
     * @throws \Exception
     */
    private function getObjectManager($objectName)
    {

        $manager = $this->getOlmManager()->find($objectName.'_manager');
        if (null == $manager) {
            throw new \Exception('The object '.$objectName.' is not exist');
        }

        return $manager;
    }

    /**
     * @param $errMess
     *
     * @return JsonResponse
     */
    private function getFailResponse($errMess)
    {
        return new JsonResponse(['success' => 'nok', 'errMess' => $errMess]);
    }

    /**
     * @param array $data
     *
     * @return JsonResponse
     */
    private function getSuccessResponse($data)
    {
        return new JsonResponse(['success' => 'ok', 'data' => $data]);
    }

    /**
     * @param string  $entityName
     * @param Request $request
     *
     * @return Response
     */
    public function getAction($entityName, Request $request)
    {
        try {
            $entity = $this->getObjectManager($entityName)->rGet($request->request->get('id'));

            return $this->getSuccessResponse($entity->getData());

        } catch (\Exception $e) {
            return $this->getFailResponse($e->getMessage());
        }
    }

    /**
     * @param string  $entityName
     * @param Request $request
     *
     * @return Response
     */
    public function findAction($entityName, $request)
    {
        try {
            $entities = $this->getObjectManager($entityName)->findBy($request->request->all());
            $data = [];
            foreach ($entities as $entity) {
                $data[] = $entity->getData();
            }

            return $this->getSuccessResponse($data);

        } catch (\Exception $e) {
            return $this->getFailResponse($e->getMessage());
        }
    }

    /**
     * @param string  $entityName
     * @param Request $request
     *
     * @return Response
     */
    public function createAction($entityName, $request)
    {
        try {
            $entity = $this->getObjectManager($entityName)->create($request->request);

            return $this->getSuccessResponse($entity->getData());

        } catch (\Exception $e) {
            return $this->getFailResponse($e->getMessage());
        }
    }

    /**
     * @param string  $entityName
     * @param Request $request
     *
     * @return Response
     */
    public function updateAction($entityName, $request)
    {
        try {
            $this->getObjectManager($entityName)->update($request->request);

            return $this->getSuccessResponse([]);
        } catch (\Exception $e) {
            return $this->getFailResponse($e->getMessage());
        }
    }

    /**
     * @param string  $entityName
     * @param Request $request
     *
     * @return Response
     */
    public function removeAction($entityName, $request)
    {
        try {
            $this->getObjectManager($entityName)->remove($request->request->get('id'));

            return $this->getSuccessResponse([]);
        } catch (\Exception $e) {
            return $this->getFailResponse($e->getMessage());
        }
    }

    /**
     * @return JsonResponse
     */
    public function getListEntitiesAction()
    {
        $managers = $this->getOlmManager()->all();
        $data = [];
        foreach($managers as $manager) {
            $name = explode('_', $manager->getName());
            $data = $name[0];
        }
        return $this->getSuccessResponse($data);
    }
}