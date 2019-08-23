<?php

namespace App\Controller;


use App\Form\ProductType;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/create", name="product_create")
     */
    public function index(Request $request)
    {
        $product=new Product();
        $form=$this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
         
        if($form->isSubmitted() && $form->isValid()){

               

                //on recup Doctrine
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
    }
        
        return $this->render('form/contact_form.html.twig', [
            'controller_name' => 'ProductController',
            'form'=> $form->createView(),
        ]);
    
    }
}
