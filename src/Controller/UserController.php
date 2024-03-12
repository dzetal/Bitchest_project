<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Wallet;
use App\Repository\WalletRepository;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
    // Existing methods..
    
        #[Route('/user/{id}/initialize-wallet', name: 'app_user_initialize_wallet', methods: ['POST'])]
        public function initializeWallet(User $user, EntityManagerInterface $entityManager): Response
        {
            $existingWallet = $user->getWallet();
            
            // Check if user already has a wallet
            if ($existingWallet !== null) {
                // Redirect or return appropriate response
            }
    
            // Create a new wallet for the user with an initial balance of 500 euros
            $wallet = new Wallet();
            $wallet->setBalance(500);
            $wallet->setUser($user);
            $entityManager->persist($wallet);
            $entityManager->flush();
    
            // Redirect or return appropriate response
        }
    
        #[Route('/user/{id}/portfolio', name: 'app_user_portfolio', methods: ['GET'])]

        public function portfolio(User $user, WalletRepository $walletRepository): Response
        {
            $wallet = $user->getWallet();
            
            // Fetch the list of cryptocurrencies owned by the user and their respective purchase details
            // Example: $cryptoList = $wallet->getCryptocurrencies();
    
            return $this->render('user/portfolio.html.twig', [
                'user' => $user,
                'wallet' => $wallet,
                // Pass any other necessary data to the template
            ]);
        }
    
        #[Route('/user/{id}/sell-crypto', name: 'app_user_sell_crypto', methods: ['POST'])]
        public function sellCrypto(Request $request, User $user, EntityManagerInterface $entityManager): Response
        {
            // Sell cryptocurrency logic
    
            // Redirect or return appropriate response
        }
    
        #[Route('/user/{id}/buy-crypto', name: 'app_user_buy_crypto', methods: ['POST'])]
        public function buyCrypto(Request $request, User $user, EntityManagerInterface $entityManager): Response
        {
            // Buy cryptocurrency logic
    
            // Redirect or return appropriate response
        }
    }
    