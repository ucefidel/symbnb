<?php

namespace App\Repository;

use App\Entity\PasswordUpdatePhp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PasswordUpdatePhp|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasswordUpdatePhp|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasswordUpdatePhp[]    findAll()
 * @method PasswordUpdatePhp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasswordUpdatePhpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PasswordUpdatePhp::class);
    }

    // /**
    //  * @return PasswordUpdatePhp[] Returns an array of PasswordUpdatePhp objects
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
    public function findOneBySomeField($value): ?PasswordUpdatePhp
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
