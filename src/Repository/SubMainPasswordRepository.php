<?php

namespace App\Repository;

use App\Entity\SubMainPassword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubMainPassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubMainPassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubMainPassword[]    findAll()
 * @method SubMainPassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubMainPasswordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubMainPassword::class);
    }

    // /**
    //  * @return SubMainPassword[] Returns an array of SubMainPassword objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubMainPassword
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
