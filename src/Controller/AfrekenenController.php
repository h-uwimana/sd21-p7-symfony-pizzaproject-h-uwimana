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
    public function index(Request $request): Response
    {
        $bestelling = new Bestelling();

        $form = $this->createForm(BestellingType::class, $bestelling);

        return $this->render('afrekenen/index.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
