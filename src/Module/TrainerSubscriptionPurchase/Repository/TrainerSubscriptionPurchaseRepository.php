<?php

namespace App\Module\TrainerSubscriptionPurchase\Repository;

use App\Module\TrainerSubscriptionPurchase\Entity\TrainerSubscriptionPurchase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainerSubscriptionPurchase>
 *
 * @method TrainerSubscriptionPurchase|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainerSubscriptionPurchase|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainerSubscriptionPurchase[]    findAll()
 * @method TrainerSubscriptionPurchase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainerSubscriptionPurchaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainerSubscriptionPurchase::class);
    }

    public function save(TrainerSubscriptionPurchase $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TrainerSubscriptionPurchase $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TrainerSubscriptionPurchase[] Returns an array of TrainerSubscriptionPurchase objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TrainerSubscriptionPurchase
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
