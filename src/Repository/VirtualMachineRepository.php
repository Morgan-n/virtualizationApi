<?php

namespace App\Repository;

use App\Entity\VirtualMachine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VirtualMachine>
 *
 * @method VirtualMachine|null find($id, $lockMode = null, $lockVersion = null)
 * @method VirtualMachine|null findOneBy(array $criteria, array $orderBy = null)
 * @method VirtualMachine[]    findAll()
 * @method VirtualMachine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VirtualMachineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VirtualMachine::class);
    }

    public function save(VirtualMachine $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VirtualMachine $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return VirtualMachine[] Returns an array of VirtualMachine objects
    */
   public function findByExampleField($value): array
   {
       return $this->createQueryBuilder('v')
           ->andWhere('id = :val')
           ->setParameter('val', $value)
           ->orderBy('v.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?VirtualMachine
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
