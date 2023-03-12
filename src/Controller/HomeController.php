<?php

namespace App\Controller;

use Doctrine\Common\Collections\Selectable;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    #[Route('/')]
    public function show(ManagerRegistry $doctrine, ):Response
    {
        $products=$doctrine->getRepository(Product::class)->findAll();
        $category=$doctrine->getRepository(Category::class)->findAll();
//        dd($products);
       return  $this->render("home/index.html.twig", ["products"=>$products, "category"=>$category]);
    }


    #[Route('/category/{id}')]
    public function getCategory(ManagerRegistry $doctrine,int $id):Response
    {
        $products=$doctrine->getRepository(Product::class)->findBy(array("category"=>$id));
        $category=$doctrine->getRepository(Category::class)->findAll();
//        dd($products);
        return  $this->render("home/index.html.twig", ["products"=>$products, "category"=>$category]);
    }
}
