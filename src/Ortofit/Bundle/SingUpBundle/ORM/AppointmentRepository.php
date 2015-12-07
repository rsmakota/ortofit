<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\ORM;

use Doctrine\ORM\EntityRepository;
use Ortofit\Bundle\SingUpBundle\Entity\Appointment;
use Ortofit\Bundle\SingUpBundle\Entity\Office;

/**
 * Class AppointmentRepository
 *
 * @package Ortofit\Bundle\SingUpBundle\ORM
 */
class AppointmentRepository extends EntityRepository
{
    /**
     * @param \DateTime $dayFrom
     * @param \DateTime $dayTo
     * @param Office    $office
     *
     * @return array
     */
    public function findByRange(\DateTime $dayFrom, \DateTime $dayTo, Office $office)
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $params = ['dayFrom' => $dayFrom, 'dayTo' => $dayTo, 'office' => $office];
        $qb = $builder->select('a')
            ->from(Appointment::clazz(), 'a')
            ->where('a.dateTime > :dayFrom AND a.dateTime < :dayTo')
            ->andWhere('a.office = :office')
            ->setParameters($params);

        return $qb->getQuery()->getResult();
    }
}