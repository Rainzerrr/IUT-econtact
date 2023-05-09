<?php

namespace App\Repository;

use App\Entity\Contacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contacts>
 *
 * @method Contacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contacts[]    findAll()
 * @method Contacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contacts::class);
    }

    public function save(Contacts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Contacts $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllContacts(int $userId): array
    {

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery('
        SELECT u FROM App\Entity\Users u
        WHERE u.id != :userId AND u.id IN (
            SELECT c.user FROM App\Entity\Contacts c
            WHERE c.contact = :userId
        )
        OR u.id IN (
            SELECT co.contact FROM App\Entity\Contacts co
            WHERE co.user = :userId
        )
    ');

        $query->setParameter('userId', $userId);

        return $query->getResult();
    }

    public function findByFriend(int $userId, int $contactId): array
    {
        $a = $this->createQueryBuilder('c')
            ->where('c.user = :user')
            ->setParameter('user', $userId)
            ->andWhere('c.contact = :contact')
            ->setParameter('contact', $contactId)
            ->getQuery()
            ->getResult();
        if (count($a) == 0) {
            return $this->createQueryBuilder('c')
                ->where('c.user = :user')
                ->setParameter('user', $contactId)
                ->andWhere('c.contact = :contact')
                ->setParameter('contact', $userId)
                ->getQuery()
                ->getResult();
        }
        return $a;
    }

    //    /**
    //     * @return Contacts[] Returns an array of Contacts objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contacts
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
