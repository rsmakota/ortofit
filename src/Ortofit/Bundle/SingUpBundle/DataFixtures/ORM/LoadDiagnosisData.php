<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ortofit\Bundle\SingUpBundle\Entity\Diagnosis;

/**
 * Class LoadDiagnosisData
 * @package Ortofit\Bundle\SingUpBundle\DataFixtures\ORM
 */
class LoadDiagnosisData extends AbstractFixture implements OrderedFixtureInterface
{

    private $personData =
        [
            'person:son'      => 'кифоз-скалиоз',
            'person:daughter' => 'плоскостопие',
            'person:husband'  => 'коксоартроз, тазобед. сустав'

        ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach($this->personData as $personRef => $diagnosisText) {
            $diagnosis = new Diagnosis();
            $diagnosis->setPerson($this->getReference($personRef));
            $diagnosis->setContent($diagnosisText);

            $manager->persist($diagnosis);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 160;
    }
}