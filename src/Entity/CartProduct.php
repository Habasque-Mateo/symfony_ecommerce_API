<?php

namespace App\Entity;

use App\Repository\CartProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartProductRepository::class)
 */
class CartProduct
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="cartProducts")
     * @ORM\JoinColumn(name="cartId", referencedColumnName="id", nullable=false)
     */
    private $cartId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Catalog::class, inversedBy="cartProducts")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id", nullable=false)
     */
    private $productId;

    public function getCartId(): ?Cart
    {
        return $this->cartId;
    }

    public function setCartId(?Cart $cartId): self
    {
        $this->cartId = $cartId;

        return $this;
    }

    public function getProductId(): ?Catalog
    {
        return $this->productId;
    }

    public function setProductId(?Catalog $productId): self
    {
        $this->productId = $productId;

        return $this;
    }
}
