<?php

namespace App\Controller;

use App\Form\PrimeFactorsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PrimeFactorizationController extends AbstractController
{
    public function findPrimeFactors(Request $request): Response
    {
        $form = $this->createForm(PrimeFactorsType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        }

        return $this->render(
            'primeFactorization.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}