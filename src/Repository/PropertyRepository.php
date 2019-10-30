<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @param PropertySearch $property_search
     * @return Query
     */
    public function findAllNotSoldQuery(PropertySearch $property_search): Query
    {
        $query = $this->findAllQuery();

        if ($property_search->getMaxPrice()) {
            $query = $query
                ->andWhere('p.price <= :max_price')
                ->setParameter('max_price', $property_search->getMaxPrice());
        }

        if ($property_search->getMinSurface()) {
            $query = $query
                ->andWhere('p.surface >= :min_surface')
                ->setParameter('min_surface', $property_search->getMinSurface());
        }

        if ($property_search->getOptions()->count() > 0) {
            $key = 0;
            foreach ($property_search->getOptions() as $option) {
                $key++;
                $query = $query
                    ->andWhere(":option$key MEMBER OF p.options")
                    ->setParameter("option$key", $option);
            }
        }

        return $query->getQuery();
    }

    /**
     * @return Property[] Returns an array of Property objects
     */
    public function findLatest(): array
    {
        return $this->findAllQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
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

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    private function findAllQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = false');
    }
}
