<?php

namespace App\Repository;

use App\Entity\Additif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Additif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Additif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Additif[]    findAll()
 * @method Additif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdditifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Additif::class);
    }

    // /**
    //  * @return Additif[] Returns an array of Additif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Additif
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
