<?php

namespace App\Repository;

use App\Entity\Ready;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ready|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ready|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ready[]    findAll()
 * @method Ready[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReadyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ready::class);
    }

    // /**
    //  * @return Ready[] Returns an array of Ready objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ready
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
