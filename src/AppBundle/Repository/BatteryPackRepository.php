<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
/**
 * Class BatteryPackRepository
 * @package AppBundle\Repository
 */
class BatteryPackRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getBatteriesStatistics()
    {
        $queryBuilder = $this->createQueryBuilder('b')
        ->select('b.type', 'SUM(b.count) as total')
        ->groupBy('b.type');
        return $queryBuilder->getQuery()->getResult();
    }
}
