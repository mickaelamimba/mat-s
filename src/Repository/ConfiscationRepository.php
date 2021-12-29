<?php

namespace App\Repository;

use App\Entity\Confiscation;
use App\Entity\Material;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Confiscation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Confiscation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Confiscation[]    findAll()
 * @method Confiscation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfiscationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Confiscation::class);
    }

    // /**
    //  * @return Confiscation[] Returns an array of Confiscation objects
    //  */

    public function findAllWithMaterial()
    {
        return $this->createQueryBuilder('c')
            ->join('c.materials','m')
            ->where('m.id = :material_id ')
            ->setParameter('material_id',2)
            ->getQuery()
            ->getResult()

        ;
    }


    /*
    public function findOneBySomeField($value): ?Confiscation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
