<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product", name="product")
     */
    public function index()
    {
        $product = $this->getDoctrine()->getRepository('App:Product')->findAll();

        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find(1);


        $categoryName = $product->getCategory()->getName();

        dump($categoryName);exit;
    }

    /**
     * @Route("/product/new", name="newProduct")
     */
    public function addAction()
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Keyboard');

        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }
}
