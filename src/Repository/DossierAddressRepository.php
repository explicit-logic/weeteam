<?php

namespace App\Repository;

use App\Entity\DossierAddress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DossierAddress|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierAddress|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierAddress[]    findAll()
 * @method DossierAddress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierAddressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierAddress::class);
    }

    // /**
    //  * @return DossierAddress[] Returns an array of DossierAddress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DossierAddress
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
