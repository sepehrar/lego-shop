<?php

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use \App\Entity\Product;

class CartService

{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function add(Product $product)
    {
        $cart = $this->session->get('cart', []);
        $cart[] = $product;
        $this->session->set('cart', $cart);
    }

    public function getCart()

    {
        return $this->session->get('cart', []);
    }

    public function remove(Product $product)
    {
        $cart = $this->session->get('cart', []);
        // Logic to remove product from cart
        $this->session->set('cart', $cart);
    }
}