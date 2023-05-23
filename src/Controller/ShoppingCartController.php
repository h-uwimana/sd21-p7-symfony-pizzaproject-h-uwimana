<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ShoppingCartController extends AbstractController
{
    #[Route('/shoppingCart', name: 'app_shopping_cart')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $allSession = $session->all();
        if(empty($allSession) ){
            return $this->redirectToRoute("home");
        }

        return $this->render('shopping_cart/index.html.twig', [
            'controller_name' => 'ShoppingCartController',
        ]);
    }

    #[Route('/addCart/', name: 'addCart')]
    public function addCart(ValidatorInterface $validator,ManagerRegistry $doctrine,Request $request):Response    {

        $session = $request->getSession();
        $price = (float) $request->request->get("price");
        $id = (int) $request->request->get("id");
        $name = $request->request->get("name");
        $products=$doctrine->getRepository(Product::class)->findOneBy(array("id"=>$id));
        $small = $products->getSmall();
        $medium = $products->getMedium();
        $large = $products->getLarge();
        if($price === (float)$small){
            $array = [
                "id" => $products->getId(),
                "name" => $products->getName(),
                "image" => $products->getPicture(),
                "price" => $small,
                "size" => "small",
                "amount" => +1,
            ];
            if(in_array($array,$session->all() )){
                $array["amount"] = $array["amount"] + 1;
            }
            $session->set("$id small", $array);
            return $this->redirectToRoute("home");
        }elseif($price === (float)$medium){
            $array = [
                "id" => $products->getId(),
                "name" => $products->getName(),
                "image" => $products->getPicture(),
                "price" => $price,
                "size" => "medium",
                "amount" => +1,
            ];

            if(in_array($array,$session->all() )){
                $array["amount"] = $array["amount"] + 1;
            }
            $session->set("$id medium", $array );
            return $this->redirectToRoute("home");
        }elseif($price === (float)$large){

            $array = [
                "id" => $products->getId(),
                "name" => $products->getName(),
                "image" => $products->getPicture(),
                "price" => $price,
                "size" => "large",
                "amount" => +1,
            ];
            if(in_array($array,$session->all() )){
                $array["amount"] = $array["amount"] + 1;
            }


            $session->set("$id large", $array);

            return $this->redirectToRoute("home");
        }else{
            return new Response("hoi");
        }

    }


    #[Route('/updateCart/', name: 'updateCart')]
    public function updateCart(ValidatorInterface $validator,ManagerRegistry $doctrine,Request $request):Response    {

        $session =  $request->getSession();
        $id = (int) $request->get("id");
        $size = (string) $request->get("size");
        $amount = (int) $request->get("amount");
        $name = $request->get("name");
        $price = (float) $request->get("price");
        $image = $request->get("image");

        $array = [
            "id" => $id,
            "name" => $name,
            "image" => $image,
            "price" => $price,
            "size" => $size,
            "amount" => $amount,
        ];

        $session->set("$id $size", $array);



        $product = $session->get("$id $size");



        $allSession = $session->all();;

        return new Response(json_encode($array));
    }

    #[Route('/removeCart/', name: 'removeCart')]
    public function removeCart(ValidatorInterface $validator,ManagerRegistry $doctrine,Request $request):Response    {

        $session = $request->getSession();
        $id = $request->get("id");
        $size = strval($request->get("size"));

        $session->remove("$id $size");

        $allSession = $session->all();

        return new Response(json_encode($allSession));
    }
}
