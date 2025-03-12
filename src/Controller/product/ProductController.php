<?php

namespace App\Controller\product;

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
}
