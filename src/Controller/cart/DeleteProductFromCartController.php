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

final class DeleteProductFromCartController extends AbstractController
{
    // Remove a product from the cart
    #[Route('/product/{id}/remove-from-cart', name: 'product_remove_from_cart', methods: ['POST'])]
    public function removeFromCart(Product $product, CartService $cartService): Response
    {
        $cartService->remove($product);

        $this->addFlash('success', 'Product removed from cart!');
        return $this->redirectToRoute('app_product');
    }

}
