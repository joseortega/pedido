<?php

namespace App\Repository;

use App\Entity\Purchase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Collections\Criteria;
use App\Entity\User;

/**
 * @method Purchase|null find($id, $lockMode = null, $lockVersion = null)
 * @method Purchase|null findOneBy(array $criteria, array $orderBy = null)
 * @method Purchase[]    findAll()
 * @method Purchase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PurchaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Purchase::class);
    }
    
    public function findByUserQuery(User $user): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.user =:user')
            ->setParameter('user', $user)
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        return $qb->execute();
    }
    
    public function findRequestQuery(): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere("p.status != 'edicion'")
            ->orderBy('p.requestDate', 'DESC')
            ->getQuery();

        return $qb->execute();
    }

//  /**
//     * @return Purchase[] Returns an array of Purchase objects
//     */
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
}
