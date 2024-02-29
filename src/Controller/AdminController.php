<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Form\AdminType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin')]
class AdminController extends AbstractController
{


    #[Route('/', name: 'app_admin_index', methods: ['GET'])]
    public function index(UserRepository $UR): Response
    {
       $users= $UR-> findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users,

        ]);
    }


    #[Route('/new', name: 'app_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_show', methods: ['GET'])]
    public function show(UserRepository $userRepository, User $user, $id): Response
    {
        $user = $userRepository->find((int) $id);
    
        if (!$user) {
          throw $this->createNotFoundException('User not found');
       }

        return $this->render('admin/show.html.twig', [
            'user' => $user,

        ]);
    }
    #[Route('/{id}/edit', name: 'app_admin_edit', methods: ['GET', 'POST'])]
    public function edit(UserRepository $userRepository, User $user, $id, Request $request, EntityManagerInterface $entityManager): Response
    {
          $user = $userRepository->find((int) $id);
    
          if (!$user) {
            throw $this->createNotFoundException('User not found');
         }
    
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_admin_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('admin/edit.html.twig', [
             'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    
    

    #[Route('/{id}', name: 'app_admin_delete', methods: ['POST'])]
    public function delete(UserRepository $UR, Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $users= $UR-> findAll();
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_index', ['users' => $users], Response::HTTP_SEE_OTHER);
    }
}

