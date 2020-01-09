<?php

namespace App\Domain\Repository;

use App\Domain\Model\Airplane;

/**
 * @method Airplane|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airplane|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airplane[]    findAll()
 * @method Airplane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
interface AirplaneRepositoryInterface
{
    public function save(Airplane $airplane);
}
