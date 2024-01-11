<?php

namespace App\Controller;
use App\Entity\Product;
use App\Form\ProductFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="app_products_index")
     */
    public function index(): Response
    {

        $product = new Product();

        $form = $this->createForm(ProductFormType::class, $product);

        return $this->render('products/index.html.twig', [
            'formProduct' => $form->createView(),
        ]);
    }
}
