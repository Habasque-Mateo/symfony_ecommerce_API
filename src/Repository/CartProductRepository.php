<?php

namespace App\Repository;

use App\Entity\CartProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method CartProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartProduct[]    findAll()
 * @method CartProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        parent::__construct($registry, CartProduct::class);
        $this->manager = $manager;
    }

    public function saveCartProduct($productId, $cartId)
    {
        $newCartProduct = new CartProduct();
        $newCartProduct
            ->setProductId($productId)
            ->setCartId($cartId)
        ;
        $this->manager->persist($newCartProduct);
        $this->manager->flush();

        return $newCartProduct;
    }

    public function removeCartProduct(CartProduct $cartProduct): ?CartProduct
    {
        $this->manager->remove($cartProduct);
        $this->manager->flush();
        return null;
    }

    public function findOneByPk($cartId, $productId): ?CartProduct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.cartId = :cartId')
            ->andWhere('c.productId = :productId')
            ->setParameter('cartId', $cartId)
            ->setParameter('productId', $productId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return CartProduct[] Returns an array of CartProduct objects
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
