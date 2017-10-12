<?php

namespace AppBundle\Repository;

use AppBundle\Entity\BatteryPack;
use Doctrine\ORM\EntityRepository;
/**
 * Class BatteryPackRepository
 * @package AppBundle\Repository
 */
class BatteryPackRepository extends EntityRepository
{

    /**
     * @return array|BatteryPack[]
     */
    public function getBatteriesStatistics() : array
    {
        $queryBuilder = $this->createQueryBuilder('b')
        ->select('b.type', 'SUM(b.count) as total')
        ->groupBy('b.type');

        return $queryBuilder->getQuery()->getResult();
    }
}
