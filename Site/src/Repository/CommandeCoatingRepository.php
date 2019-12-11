<?php

namespace App\Repository;

use App\Entity\CommandeCoating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CommandeCoating|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandeCoating|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandeCoating[]    findAll()
 * @method CommandeCoating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeCoatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandeCoating::class);
    }

    public function findLastId(): ?CommandeCoating
    {
        return $this->createQueryBuilder('c')
            ->innerJoin("c.fonction", "commande_coating_fonction")
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return CommandeCoating[] Returns an array of CommandeCoating objects
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
    public function findOneBySomeField($value): ?CommandeCoating
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
