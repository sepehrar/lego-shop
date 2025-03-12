<?php

namespace App\Controller\cart;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetCartController extends AbstractController
{
    // View the cart
    #[Route('/cart', name: 'cart_show', methods: ['GET'])]
    public function showCart(CartService $cartService): Response
    {
        return $this->render('cart/show.html.twig', [
            'cart' => $cartService->getCart(),
            'total' => $cartService->getTotal(),
        ]);
    }
}
