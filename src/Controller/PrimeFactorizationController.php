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

        $factors = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $number = $form->getData()['number'] ?? null;

            // TODO: move to a service
            // TODO: add validation (must be over 1)
            // TODO: add test coverage

            if ($this->isPrimeNumber($number)) {
                $factors = [$number];
            } else {
                $divisor = 2;

                while ($result = $number / $divisor) {
                    if (!is_int($result)) {
                        $divisor++;
                        continue;
                    }

                    $number = $result;
                    $factors[] = $divisor;

                    if ($this->isPrimeNumber($result)) {
                        $factors[] = $result;
                        break;
                    }
                }
            }
        }

        return $this->render(
            'primeFactorization.html.twig',
            [
                'form'    => $form->createView(),
                'factors' => $factors,
            ]
        );
    }

    private function isPrimeNumber(int $number): bool
    {
        if ($number <= 1) {
            return false;
        }

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    }
}