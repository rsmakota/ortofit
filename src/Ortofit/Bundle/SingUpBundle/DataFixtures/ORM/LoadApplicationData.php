<?php
/**
 * @author    Rodion Smakota <rsmakota@nebupay.com>
 * @copyright 2015 Nebupay LLC
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Application;

/**
 * Class LoadApplicationData
 *
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadApplicationData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $app = new Application();
        $app->setName('Visit');
        $app->setType(Application::TYPE_VISIT);
        $app->setCountry($this->getReference('country:ua'));
        $app->setFlowServiceName('ortofit_sing_up.application_flow');
        $app->setConfig([
            'template' => [
                'name' => 'OrtofitSingUpBundle:SingUp:index.html.twig'
            ],
            'notify'     => [
                'subject' => 'Запись на прием',
                'body'    => 'Прошу перезвонить мне по тел. +%s и записать на прием.'
            ]
        ]);

        $manager->persist($app);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 120;
    }
}