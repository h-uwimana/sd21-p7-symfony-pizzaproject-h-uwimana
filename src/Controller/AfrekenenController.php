<?php

namespace App\Controller;

use App\Entity\Bestelling;
use App\Form\BestellingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfrekenenController extends AbstractController
{
    #[Route('/checkout', name: 'checkout')]
    public function index(Request $request,): Response
    {
        $bestelling = new Bestelling();

        $form = $this->createForm(BestellingType::class, $bestelling);

//        dd($form);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            dd($task);

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('home');
        }


        return $this->render('afrekenen/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
