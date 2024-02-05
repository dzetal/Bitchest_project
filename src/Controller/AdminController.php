<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(UserRepository $UR): Response
    {
       $users= $UR-> findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users,

        ]);
    }
}
