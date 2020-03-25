<?php

namespace App\Repository;

use App\Entity\DossierCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DossierCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method DossierCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method DossierCard[]    findAll()
 * @method DossierCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DossierCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DossierCard::class);
    }

    // /**
    //  * @return DossierCard[] Returns an array of DossierCard objects
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
    public function findOneBySomeField($value): ?DossierCard
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
