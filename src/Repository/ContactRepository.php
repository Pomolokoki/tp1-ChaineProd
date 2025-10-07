<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use NumberFormatter;
use function Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Contact>
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @return Contact[] Returns an array of Contact objects
     */
    public function paginate(int $page, int $limit, string $status, string $search = null): array
    {
        $offset = ($page -1) * $limit;

        $qb = $this->createQueryBuilder('c');
        
        if ($status !== 'all') {
            $qb->andWhere($qb->expr()->eq('c.status', ':status'))
                ->setParameter('status',$status);
        }
        if ($search !== null) {
            $qb
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('c.firstName', ':search'),
                    $qb->expr()->like('c.name', ':search'),
                ),
            )
            ->setParameter('search', '%'.$search.'%');                
        }
        $qb
        ->setFirstResult($offset)
        ->setMaxResults($limit);
        
        $result = $qb->getQuery()
            ->getResult();

        return $result;
    }

    public function countResult(int $page, int $limit, string $status, string $search = null): int
    {
        $offset = ($page -1) * $limit;

        $qb = $this->createQueryBuilder('c');
        
        if ($status !== 'all') {
            $qb->andWhere($qb->expr()->eq('c.status', ':status'))
                ->setParameter('status',$status);
        }
        if ($search !== null) {
            $qb
            ->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('c.firstName', ':search'),
                    $qb->expr()->like('c.name', ':search'),
                ),
            )
            ->setParameter('search', '%'.$search.'%');                
        }

        
        $result = $qb->getQuery()
            ->getResult();

        return count($result);
    }
}
