<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Service;


use Ortofit\Bundle\SingUpBundle\Entity\Application;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 * Class ApplicationManager
 *
 * @package Ortofit\Bundle\SingUpBundle\Service
 */
class ApplicationManager extends AbstractManager
{
    /**
     * @param integer $appId
     *
     * @return Application
     *
     * @throws \Exception
     */
    public function getApp($appId)
    {
        $app = $this->enManager->getRepository(Application::clazz())->find($appId);
        if (null == $app) {
            throw new \Exception('Can\'t find Application by id <<'.$appId.'>>');
        }

        return $app;
    }

    /**
     * @param ParameterBag $bag
     *
     * @return Application
     */
    public function create($bag)
    {
        // TODO: Implement create() method.
    }
}