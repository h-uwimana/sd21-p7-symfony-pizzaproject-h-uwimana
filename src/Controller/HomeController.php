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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    #[Route('/', name: "home")]
    public function show(ManagerRegistry $doctrine,Request $request ):Response
    {
        $session = $request->getSession();

//        dd($session);
        $products=$doctrine->getRepository(Product::class)->findAll();
        $category=$doctrine->getRepository(Category::class)->findAll();

        $task = new Order();
//        dd($request);
        $form = $this->createForm(CartType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            dd($form->getData());
        }
//            dd($form);
       return  $this->renderform("home/index.html.twig", ["form"=>$form,"products"=>$products, "category"=>$category,
           ]);
    }


    #[Route('/category/{id}', name: 'category')]
    public function getCategory(ManagerRegistry $doctrine,int $id, Request $request):Response
    {


//        dd($session);
        $products=$doctrine->getRepository(Product::class)->findBy(array("category"=>$id));
        $category=$doctrine->getRepository(Category::class)->findAll();

        $task = new Order();

        $form = $this->createForm(CartType::class, $task);

        $form = $this->createForm(CartType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            dd($form->getData());
        }
        return  $this->render("home/index.html.twig", ["products"=>$products, "category"=>$category,
            "form"=>$form->createView()]);
    }

    #[Route('/addCart/', name: 'addCart')]
    public function addCart(ManagerRegistry $doctrine,Request $request):Response    {
        dd($request);
        $form = $this->createForm(CartType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            dd($form->getData());
        }
        return new Response("hoi");
    }
}






