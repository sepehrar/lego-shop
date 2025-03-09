<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ProductController extends AbstractController
{
    // List all products
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $productRepository, CartService $cartService): Response
    {
        $products = $productRepository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'cart' => $cartService->getCart(), // Pass the cart to the template
            'total' => $cartService->getTotal(), // Pass the total to the template
        ]);
    }

    // Add a product to the cart
    #[Route('/product/{id}/add-to-cart', name: 'product_add_to_cart', methods: ['POST'])]
    public function addToCart(Request $request, Product $product, CartService $cartService): Response
    {
        $quantity = $request->request->getInt('quantity', 1); // Get quantity from the form
        $cartService->add($product, $quantity);

        $this->addFlash('success', 'Product added to cart!');
        return $this->redirectToRoute('app_product');
    }

    // Remove a product from the cart
    #[Route('/product/{id}/remove-from-cart', name: 'product_remove_from_cart', methods: ['POST'])]
    public function removeFromCart(Product $product, CartService $cartService): Response
    {
        $cartService->remove($product);

        $this->addFlash('success', 'Product removed from cart!');
        return $this->redirectToRoute('app_product');
    }

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
