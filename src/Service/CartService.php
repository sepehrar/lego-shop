<?php
namespace App\Service;

use App\Entity\Product;

class CartService
{
    private $cart = [];

    public function add(Product $product, int $quantity = 1): void
    {
        $id = $product->getId();
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity'] += $quantity;
        } else {
            $this->cart[$id] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }
    }

    public function remove(Product $product): void
    {
        $id = $product->getId();
        if (isset($this->cart[$id])) {
            unset($this->cart[$id]);
        }
    }

    public function getCart(): array
    {
        return $this->cart;
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['product']->getPrice() * $item['quantity'];
        }
        return $total;
    }

    public function clear(): void
    {
        $this->cart = [];
    }
}