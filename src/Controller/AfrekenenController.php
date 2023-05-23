<?php

namespace App\Controller;

use App\Entity\Bestelling;
use App\Entity\Order;
use App\Entity\Product;
use App\Form\BestellingType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

class AfrekenenController extends AbstractController
{
    #[Route('/checkout', name: 'checkout')]
    public function index(Request $request,EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $bestelling = new Bestelling();


        $form = $this->createForm(BestellingType::class, $bestelling);
        $session = $request->getSession()->all();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $products=$doctrine->getRepository(Bestelling::class)->findOneBy(array("email"=> $bestelling->getEmail()),);
            if(!$products){
                $task =  $form->getData();
                $entityManager->persist($task);
                $entityManager->flush();
                $products=$doctrine->getRepository(Bestelling::class)->findOneBy(array("email"=> $bestelling->getEmail()));

            }


            foreach ($session as $key => $value) {
                if (is_array($value)) {
                    $order = new Order();
                    print_r($value);
                    $product = $doctrine->getRepository(Product::class)->findOneBy(array("id" => $value["id"]));
                    $order->setProduct($product);
                    $order->setBestelling($products);
                    $order->setAmount($value["amount"]);
                    $order->setPrice($value["price"]);
                    $order->setSize($value["size"]);
                    $order->setDate(new DateTimeImmutable());
                    $entityManager->persist($order);
                    $entityManager->flush();
                }
            }

            $request->getSession()->clear();

                       return $this->redirectToRoute('home');
        }


        return $this->render('afrekenen/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
