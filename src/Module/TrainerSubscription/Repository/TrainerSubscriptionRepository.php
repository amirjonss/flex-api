<?php

namespace App\Module\TrainerSubscription\Repository;

use App\Module\TrainerSubscription\Entity\TrainerSubscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainerSubscription>
 *
 * @method TrainerSubscription|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainerSubscription|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainerSubscription[]    findAll()
 * @method TrainerSubscription[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainerSubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainerSubscription::class);
    }

    public function save(TrainerSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TrainerSubscription $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TrainerSubscription[] Returns an array of TrainerSubscription objects
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

//    public function findOneBySomeField($value): ?TrainerSubscription
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
