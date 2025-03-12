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

final class AddNewProductToCartController extends AbstractController
{
    // Add a product to the cart
    #[Route('/product/{id}/add-to-cart', name: 'product_add_to_cart', methods: ['POST'])]
    public function addToCart(Request $request, Product $product, CartService $cartService): Response
    {
        $quantity = $request->request->getInt('quantity', 1); // Get quantity from the form
        $cartService->add($product, $quantity);

        $this->addFlash('success', 'Product added to cart!');
        return $this->redirectToRoute('app_product');
    }
}
