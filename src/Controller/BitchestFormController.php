<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BitchestFormController extends AbstractController
{
    #[Route('/bitchest/form', name: 'app_bitchest_form')]
    public function index(): Response
    {
        return $this->render('bitchest_form/index.html.twig', [
            'controller_name' => 'BitchestFormController',
        ]);
    }
}
