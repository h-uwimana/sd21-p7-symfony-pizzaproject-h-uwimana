<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\CartType;
use Doctrine\Common\Collections\Selectable;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{


    #[Route('/', name: "home")]
    public function show(RequestStack $requestStack ,ValidatorInterface $validator,ManagerRegistry $doctrine,Request $request ):Response
    {
        $session = $request->getSession()->all();

//        dd($request);

        $products=$doctrine->getRepository(Product::class)->findAll();
        $category=$doctrine->getRepository(Category::class)->findAll();



       return  $this->render("home/index.html.twig", ["products"=>$products, "category"=>$category,
           ]);
    }


    #[Route('/category/{id}', name: 'category')]
    public function getCategory(ValidatorInterface $validator,ManagerRegistry $doctrine,int $id, Request $request):Response
    {


        $products=$doctrine->getRepository(Product::class)->findBy(array("category"=>$id));
        $category=$doctrine->getRepository(Category::class)->findAll();


        return  $this->render("home/index.html.twig", ["products"=>$products, "category"=>$category,
           ]);
    }


}






