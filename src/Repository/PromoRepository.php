<?php

namespace App\Repository;

use App\Entity\Promo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Promo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promo[]    findAll()
 * @method Promo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Promo::class);
    }

    // /**
    //  * @return Promo[] Returns an array of Promo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Promo
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByGroupePrincipal($value)
    {
        return $this->createQueryBuilder('p')
            ->innerjoin('p.groupes','g')
            ->andWhere('g.statut = :val')
            ->setParameter('val', $value)
            
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByApprenantAttente($value)
    {
        return $this->createQueryBuilder('p')
            ->innerjoin('p.groupes','g')
            ->innerjoin('g.apprenants','a')
            ->andWhere('a.statut = :val')
            ->setParameter('val', $value)
            
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByidGroupePrincipal($id, $value)
    {
        return $this->createQueryBuilder('p')
            
            ->andWhere('p.id = :val')
            ->setParameter('val', $id)
            ->innerjoin('p.groupes','g')
            ->andWhere('g.statut = :val')
            ->setParameter('val', $value)
            
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByidApprenantAttente($id, $value)
    {
        return $this->createQueryBuilder('p')
            
            ->andWhere('p.id = :val')
            ->setParameter('val', $id)
            ->innerjoin('p.groupes','g')
            ->innerjoin('g.apprenants','a')
            ->andWhere('a.statut = :val')
            ->setParameter('val', $value)
            
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByidGrpidAppr($id, $id2)
    {
        return $this->createQueryBuilder('p')
            
            ->andWhere('p.id = :val')
            ->setParameter('val', $id)
            ->innerjoin('p.groupes','g')
            ->andWhere('g.id = :val')
            ->setParameter('val', $id2)
            
            ->getQuery()
            ->getResult()
        ;
    }

    
}
