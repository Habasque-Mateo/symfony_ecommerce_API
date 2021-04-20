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
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="cartProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cartId;

    /**
     * @ORM\ManyToOne(targetEntity=Catalog::class, inversedBy="cartProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productId;

    public function getId(): ?int
    {
        return $this->id;
    }

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
