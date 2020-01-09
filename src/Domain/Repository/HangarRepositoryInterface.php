<?php

namespace App\Domain\Repository;

use App\Domain\Model\Hangar;

/**
 * @method Hangar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hangar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hangar[]    findAll()
 * @method Hangar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface HangarRepositoryInterface
{
    public function save(Hangar $hangar);
}
