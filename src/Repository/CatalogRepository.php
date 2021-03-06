<?php

namespace App\Repository;

use App\Entity\Catalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Catalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catalog[]    findAll()
 * @method Catalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatalogRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, Catalog::class);
        $this->manager = $manager;
    }

    public function saveCatalog($name, $description, $photo, $price)
    {
        $newCatalog = new Catalog();
        $newCatalog
            ->setName($name)
            ->setDescription($description)
            ->setPhoto($photo)
            ->setPrice($price);
        
        $this->manager->persist($newCatalog);
        $this->manager->flush();

        return $newCatalog;
    }

    public function findOneById($productId): ?Catalog
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $productId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function updateCatalog(Catalog $product): ?Catalog
    {
        $this->manager->persist($product);
        $this->manager->flush();
        return $product;
    }

    public function removeCatalog(Catalog $product): ?Catalog
    {
        $this->manager->remove($product);
        $this->manager->flush();
        return null;
    }

    // /**
    //  * @return Catalog[] Returns an array of Catalog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    
}
