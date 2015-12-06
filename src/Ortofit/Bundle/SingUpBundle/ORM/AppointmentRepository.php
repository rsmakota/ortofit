<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\ORM;

use Doctrine\ORM\EntityRepository;
use Ortofit\Bundle\SingUpBundle\Entity\Appointment;

/**
 * Class AppointmentRepository
 * @package Ortofit\Bundle\SingUpBundle\ORM
 */
class AppointmentRepository extends EntityRepository
{
    /**
     * @param \DateTime $dayFrom
     * @param \DateTime $dayTo
     *
     * @return array
     */
    public function findByRange(\DateTime $dayFrom, \DateTime $dayTo)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $qb = $builder->select('a')
            ->from(Appointment::clazz(), 'a')
            ->where('a.dateTime > :dayFrom AND a.dateTime < :dayTo')
            ->setParameters(['dayFrom' => $dayFrom, 'dayTo' => $dayTo]);

        return $qb->getQuery()->getResult();
    }
}