<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    #[Route('/')]
    public function show(ManagerRegistry $doctrine):Response
    {
        $products=$doctrine->getRepository(Product::class)->findAll();
       return  $this->render("home/index.html.twig", ["products"=>$products]);
    }
}
