<?php

namespace App\Repository;

use App\Entity\Material;
use App\Search\SearchMaterial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Material|null find($id, $lockMode = null, $lockVersion = null)
 * @method Material|null findOneBy(array $criteria, array $orderBy = null)
 * @method Material[]    findAll()
 * @method Material[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @property PaginatorInterface $paginator
 */
class MaterialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Material::class);
        $this->paginator = $paginator;
    }

    // /**
    //  * @return PaginationInterface Returns an array of Material objects
    //  */

    public function findAllMaterialAndTypeAndConfiscation(SearchMaterial $search):PaginationInterface
    {
      $query = $this->createQueryBuilder('m')
          ->addSelect('type')
          ->addSelect('confiscation')
            ->join('m.type','type')
            ->join('m.confiscation','confiscation');
            if(!empty($search->getQ())){
                $query =$query
                    ->andWhere('m.imeiNumber LIKE :q')
                    ->orWhere(' m.marque LIKE :marque')
                    ->orWhere('confiscation.pvNumber LIKE :pv')
                    ->setParameter('pv',"%{$search->getQ()}%")
                    ->setParameter('marque',"%{$search->getQ()}%")
                    ->setParameter('q',"%{$search->getQ()}%");
            }

        if(!empty($search->getType())){
            $query =$query
                ->andWhere('type.id IN (:type)')
                ->setParameter('type',$search->getType());
        }

        if(!empty($search->getState())){
            $query =$query
                ->andWhere('m.state IN (:state)')
                ->setParameter('state',$search->getState());
        }

        if(!empty($search->getStatus())){
            $query =$query
                ->andWhere('m.status IN (:status)')
                ->setParameter('status',$search->getStatus());
        }

         $query->getQuery();
        return $this->paginator->paginate(
            $query->getQuery(),
            $search->getPage(),
            5
        );

    }

    public function findOneMaterialById($id)
    {
        return $this->createQueryBuilder('m')
            ->addSelect('type')
            ->addSelect('confiscation')
            ->join('m.type','type')
            ->join('m.confiscation','confiscation')
            ->where('m.id = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllMaterialByTheirState($state)
    {
        return $this->createQueryBuilder('m')
            ->addSelect('type')
            ->addSelect('confiscation')
            ->join('m.type','type')
            ->join('m.confiscation','confiscation')
            ->where('m.state = :state')
            ->setParameter('state',$state)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Material
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
