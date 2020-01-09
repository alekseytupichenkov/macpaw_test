<?php

namespace App\Repository;

use App\Domain\Model\Hangar;
use App\Domain\Repository\HangarRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Hangar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hangar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hangar[]    findAll()
 * @method Hangar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HangarRepository extends ServiceEntityRepository implements HangarRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hangar::class);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Hangar $hangar)
    {
        $this->getEntityManager()->persist($hangar);
        $this->getEntityManager()->flush();
    }
}
