<?php

namespace App\Repository;

use App\Entity\FriendRequests;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FriendRequests>
 *
 * @method FriendRequests|null find($id, $lockMode = null, $lockVersion = null)
 * @method FriendRequests|null findOneBy(array $criteria, array $orderBy = null)
 * @method FriendRequests[]    findAll()
 * @method FriendRequests[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendRequestsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FriendRequests::class);
    }

    public function save(FriendRequests $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FriendRequests $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllFriendRequests(int $userId): array
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery('
        SELECT u FROM App\Entity\Users u
        WHERE u.id != :userId AND u.id IN (
            SELECT f.transmitter FROM App\Entity\FriendRequests f
            WHERE f.receiver = :userId
        )
    ');

        $query->setParameter('userId', $userId);

        return $query->getResult();
    }

//    /**
//     * @return FriendRequests[] Returns an array of FriendRequests objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FriendRequests
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
