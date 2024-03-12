<?php

    namespace App\Controller;

    use App\Entity\Transaction;
    use App\Entity\CryptoCurrency;
    use Symfony\Bundle\SecurityBundle\Security;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Repository\TransactionRepository;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\Persistence\ManagerRegistry;
    

    #[Route('/market')]
    class MarketController extends AbstractController
    {

        private $doctrine;
        private $security;

        public function __construct(ManagerRegistry $doctrine, Security $security)
        {
            $this->doctrine = $doctrine;
            $this->security = $security;
        }


        #[Route('/', name: 'market_homepage', methods: ['GET'])]
        public function index(): Response
        {        
            return $this->render('market/index.html.twig');
        }
        
        #[Route('/btc', name: 'buy_bitcoin', methods: ['GET'])]
        public function btc(): Response
        {
            return $this->render('market/bitcoin.html.twig');
            
        }   

        #[Route('/buy/bitcoin', name: 'buy_bitcoin_process', methods: ['POST'])]
        public function buyBitcoin(Request $request): Response
        {

            $entityManager = $this->doctrine->getManager();

            $user = $this->security->getUser();
            if (!$user || !$user->getId()) {
                // Display a JavaScript alert informing the user that they need to be logged in
                echo '<script>alert("You have to be logged in to perform this action.");</script>';

                // Redirect the user to the login page
                return $this->redirectToRoute('app_login');
            }
            $userId = $user->getId();

            // Handle form submission
            if ($request->isMethod('POST')) {
                $quantity = $request->request->get('quantity');

                $price = 60000;
                $amount = $quantity * $price;

                // Store transaction in the database
                $transaction = new Transaction();
                $transaction->setDate(new \DateTime());
                $transaction->setQuantity($quantity);
                $transaction->setPurchasePrice($price);
                $transaction->setAmount($amount);

                // Assuming CryptoCurrency entity has an ID of 1 for Bitcoin
                $cryptoCurrency = $entityManager->getRepository(CryptoCurrency::class)->find(1);
                $transaction->setCryptoCurrency($cryptoCurrency);

                $entityManager->persist($transaction);
                $entityManager->flush();

                // Retrieve the ID of the newly created transaction
                $transactionId = $transaction->getId();

                $conn = $entityManager->getConnection();
                $sql = 'INSERT INTO client_transaction (user_id, transaction_id) VALUES (:userId, :transactionId)';
                $stmt = $conn->prepare($sql);
                $stmt->execute(['userId' => (int)$userId, 'transactionId' => (int)$transactionId]);

                // Redirect or render success message
                return $this->redirectToRoute('market_homepage');
            }

                // Render the form
                return $this->render('market/bitcoin.html.twig');
        }

        #[Route('/eth', name: 'buy_ethereum', methods: ['GET'])]
        public function eth(): Response
        {
            return $this->render('market/ethereum.html.twig');
            
        } 
        
        #[Route('/buy/ethereum', name: 'buy_ethereum_process', methods: ['POST'])]
        public function buyEthereum(Request $request): Response
        {

            $entityManager = $this->doctrine->getManager();

            $user = $this->security->getUser();
            if (!$user || !$user->getId()) {
                // Display a JavaScript alert informing the user that they need to be logged in
                echo '<script>alert("You have to be logged in to perform this action.");</script>';

                // Redirect the user to the login page
                return $this->redirectToRoute('app_login');
            }
            $userId = $user->getId();

            // Handle form submission
            if ($request->isMethod('POST')) {
                $quantity = $request->request->get('quantity');

                $price = 4000;
                $amount = $quantity * $price;

                // Store transaction in the database
                $transaction = new Transaction();
                $transaction->setDate(new \DateTime());
                $transaction->setQuantity($quantity);
                $transaction->setPurchasePrice($price);
                $transaction->setAmount($amount);

                // Assuming CryptoCurrency entity has an ID of 1 for Bitcoin
                $cryptoCurrency = $entityManager->getRepository(CryptoCurrency::class)->find(2);
                $transaction->setCryptoCurrency($cryptoCurrency);

                $entityManager->persist($transaction);
                $entityManager->flush();

                // Retrieve the ID of the newly created transaction
                $transactionId = $transaction->getId();

                $conn = $entityManager->getConnection();
                $sql = 'INSERT INTO client_transaction (user_id, transaction_id) VALUES (:userId, :transactionId)';
                $stmt = $conn->prepare($sql);
                $stmt->execute(['userId' => (int)$userId, 'transactionId' => (int)$transactionId]);

                // Redirect or render success message
                return $this->redirectToRoute('market_homepage');
            }

                // Render the form
                return $this->render('market/ethereum.html.twig');
        }

        #[Route('/xrp', name: 'buy_ripple', methods: ['GET'])]
        public function xrp(): Response
        {
            return $this->render('market/ripple.html.twig');
            
        } 
        
        #[Route('/buy/ripple', name: 'buy_ripple_process', methods: ['POST'])]
        public function buyRipple(Request $request): Response
        {

            $entityManager = $this->doctrine->getManager();

            $user = $this->security->getUser();
            if (!$user || !$user->getId()) {
                // Display a JavaScript alert informing the user that they need to be logged in
                echo '<script>alert("You have to be logged in to perform this action.");</script>';

                // Redirect the user to the login page
                return $this->redirectToRoute('app_login');
            }
            $userId = $user->getId();

            // Handle form submission
            if ($request->isMethod('POST')) {
                $quantity = $request->request->get('quantity');

                $price = 89;
                $amount = $quantity * $price;

                // Store transaction in the database
                $transaction = new Transaction();
                $transaction->setDate(new \DateTime());
                $transaction->setQuantity($quantity);
                $transaction->setPurchasePrice($price);
                $transaction->setAmount($amount);

                // Assuming CryptoCurrency entity has an ID of 1 for Bitcoin
                $cryptoCurrency = $entityManager->getRepository(CryptoCurrency::class)->find(3);
                $transaction->setCryptoCurrency($cryptoCurrency);

                $entityManager->persist($transaction);
                $entityManager->flush();

                // Retrieve the ID of the newly created transaction
                $transactionId = $transaction->getId();

                $conn = $entityManager->getConnection();
                $sql = 'INSERT INTO client_transaction (user_id, transaction_id) VALUES (:userId, :transactionId)';
                $stmt = $conn->prepare($sql);
                $stmt->execute(['userId' => (int)$userId, 'transactionId' => (int)$transactionId]);

                // Redirect or render success message
                return $this->redirectToRoute('market_homepage');
            }

                // Render the form
                return $this->render('market/ripple.html.twig');
        }

        #[Route('/sol', name: 'buy_solana', methods: ['GET'])]
        public function sol(): Response
        {
            return $this->render('market/solana.html.twig');
            
        } 
        
        #[Route('/buy/solana', name: 'buy_solana_process', methods: ['POST'])]
        public function buySolana(Request $request): Response
        {

            $entityManager = $this->doctrine->getManager();

            $user = $this->security->getUser();
            if (!$user || !$user->getId()) {
                // Display a JavaScript alert informing the user that they need to be logged in
                echo '<script>alert("You have to be logged in to perform this action.");</script>';

                // Redirect the user to the login page
                return $this->redirectToRoute('app_login');
            }
            $userId = $user->getId();

            // Handle form submission
            if ($request->isMethod('POST')) {
                $quantity = $request->request->get('quantity');

                $price = 150;
                $amount = $quantity * $price;

                // Store transaction in the database
                $transaction = new Transaction();
                $transaction->setDate(new \DateTime());
                $transaction->setQuantity($quantity);
                $transaction->setPurchasePrice($price);
                $transaction->setAmount($amount);

                // Assuming CryptoCurrency entity has an ID of 1 for Bitcoin
                $cryptoCurrency = $entityManager->getRepository(CryptoCurrency::class)->find(4);
                $transaction->setCryptoCurrency($cryptoCurrency);

                $entityManager->persist($transaction);
                $entityManager->flush();

                // Retrieve the ID of the newly created transaction
                $transactionId = $transaction->getId();

                $conn = $entityManager->getConnection();
                $sql = 'INSERT INTO client_transaction (user_id, transaction_id) VALUES (:userId, :transactionId)';
                $stmt = $conn->prepare($sql);
                $stmt->execute(['userId' => (int)$userId, 'transactionId' => (int)$transactionId]);

                // Redirect or render success message
                return $this->redirectToRoute('market_homepage');
            }

                // Render the form
                return $this->render('market/ripple.html.twig');
        }
    }

    

?>