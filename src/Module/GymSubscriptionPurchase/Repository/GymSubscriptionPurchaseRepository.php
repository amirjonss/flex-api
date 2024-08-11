<?php

namespace App\Module\GymSubscriptionPurchase\Repository;

use App\Module\GymSubscriptionPurchase\Entity\GymSubscriptionPurchase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GymSubscriptionPurchase>
 *
 * @method GymSubscriptionPurchase|null find($id, $lockMode = null, $lockVersion = null)
 * @method GymSubscriptionPurchase|null findOneBy(array $criteria, array $orderBy = null)
 * @method GymSubscriptionPurchase[]    findAll()
 * @method GymSubscriptionPurchase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GymSubscriptionPurchaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GymSubscriptionPurchase::class);
    }

    public function save(GymSubscriptionPurchase $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GymSubscriptionPurchase $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GymSubscriptionPurchase[] Returns an array of GymSubscriptionPurchase objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GymSubscriptionPurchase
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
