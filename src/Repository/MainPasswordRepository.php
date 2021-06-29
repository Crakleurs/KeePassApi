<?php

namespace App\Repository;

use App\Entity\MainPassword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MainPassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainPassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainPassword[]    findAll()
 * @method MainPassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainPasswordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainPassword::class);
    }

    // /**
    //  * @return MainPassword[] Returns an array of MainPassword objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MainPassword
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
