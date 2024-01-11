<?php

namespace App\Controller;
use App\Entity\Product;
use App\Form\ProductFormType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="app_products_index")
     */
    public function index(Request $request): Response
    {

        $product = new Product();

        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenez l'EntityManager
            $entityManager = $this->getDoctrine()->getManager();

            // Persistez l'entité Product
            $entityManager->persist($product);

            // Flush pour sauvegarder en base de données
            $entityManager->flush();

            // Ajoutez un message flash pour indiquer le succès
            $this->addFlash('success', 'Produit créer avec succès.');

            // Redirigez vers une autre page ou effectuez toute autre action nécessaire
            return $this->redirectToRoute('app_products_index');
        }



        return $this->render('products/index.html.twig', [
            'formProduct' => $form->createView(),
        ]);
    } 
}
