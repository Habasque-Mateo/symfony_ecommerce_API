<?php

namespace App\Entity;

use App\Repository\OrderProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderProductRepository::class)
 */
class OrderProduct
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Catalog::class, inversedBy="orderProducts")
     * @ORM\JoinColumn(name="productId", referencedColumnName="id", nullable=false)
     */
    private $productId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="orderProducts")
     * @ORM\JoinColumn(name="orderId", referencedColumnName="id", nullable=false)
     */
    private $orderId;

    public function getProductId(): ?Catalog
    {
        return $this->productId;
    }

    public function setProductId(?Catalog $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getOrderId(): ?Orders
    {
        return $this->orderId;
    }

    public function setOrderId(?Orders $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }
}
