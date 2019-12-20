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

    // on définit ici la fonction findLastId qui nous permettra d'afficher un visuel du devis 
    // on récupère toutes les commandes associées à l'entité
    public function findLastId(): ?CommandeCoating
    {
        return $this->createQueryBuilder('c')
        // nous trions les commandes par leur numéro de façon décroissante (pour faire en sorte que la plus récente arrive en premier)
            ->orderBy('c.id', 'DESC')
            // on définit l'affichage des commandes à une seule, donc seul la dernière (en terme de récence, donc celle que l'utilisateur vient de finaliser ) sera affichée
            ->setMaxResults(1)
            ->getQuery()
            // on affiche la commande qui en résulte
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
