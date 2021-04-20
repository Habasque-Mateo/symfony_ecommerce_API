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
     * @ORM\JoinColumn(name="cartId", referencedColmunName="id", nullable=false)
     */
    private $cartId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Catalog::class, inversedBy="cartProducts")
     * @ORM\JoinColumn(name="productId", referencedColmunName="id", nullable=false)
     */
    private $productId;

    public function getCartId(): ?int
    {
        return $this->cartId;
    }

    public function setCartId(?int $cartId): self
    {
        $this->cartId = $cartId;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(?int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }
}
