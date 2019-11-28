<?php

namespace App\Repository;

use App\Entity\CommandeAdditif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CommandeAdditif|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeAdditif|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeAdditif[]    findAll()
 * @method CommandeAdditif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeAdditifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeAdditif::class);
    }

    // /**
    //  * @return CommandeAdditif[] Returns an array of CommandeAdditif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommandeAdditif
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
