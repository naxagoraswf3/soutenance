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

    /**
     * @return Query
     */
    public function queryLatest()
    {
        return $this->getEntityManager()
            ->createQuery(' SELECT q.id FROM AppBundle:Commande q WHERE q.id=LAST_INSERT_ID(); ') ;
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
