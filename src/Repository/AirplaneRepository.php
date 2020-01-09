<?php

namespace App\Repository;

use App\Domain\Model\Airplane;
use App\Domain\Repository\AirplaneRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Airplane|null find($id, $lockMode = null, $lockVersion = null)
 * @method Airplane|null findOneBy(array $criteria, array $orderBy = null)
 * @method Airplane[]    findAll()
 * @method Airplane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AirplaneRepository extends ServiceEntityRepository implements AirplaneRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Airplane::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Airplane $airplane)
    {
        $this->getEntityManager()->persist($airplane);
        $this->getEntityManager()->flush();
    }
}
