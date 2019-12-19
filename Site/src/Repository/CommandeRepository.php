<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }


    // on définit ici la fonction findLastId qui nous permettra d'afficher un visuel du devis 
    // on récupère toutes les commandes associées à l'entité
    public function findLastId(): ?Commande
    {
        return $this->createQueryBuilder('c')
        // nous trions les commandes par leur numéro de la plus ancienne à la plus récente
            ->orderBy('c.id', 'DESC')
            // on définit l'affichage des commandes à une seule, donc seul la dernière (en terme de récence, donc celle que l'utilisateur vient de finaliser ) sera affichée
            ->setMaxResults(1)
            ->getQuery()
            // on affiche la commande qui en résulte
            ->getOneOrNullResult()
        ;
    }
    

    // /**
    //  * @return Commande[] Returns an array of Commande objects
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
    public function findOneBySomeField($value): ?Commande
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
