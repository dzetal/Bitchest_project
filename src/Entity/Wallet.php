<?php

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $totalquantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $totalcost = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $actualcapitalgain = null;

    #[ORM\OneToOne(mappedBy: 'HasWallet', cascade: ['persist', 'remove'])]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'ClientWallet')]
    private ?Client $stop = null;

    #[ORM\ManyToOne(inversedBy: 'HasWallet')]
    private ?CryptoCurrency $cryptoCurrency = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Wallet = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalquantity(): ?string
    {
        return $this->totalquantity;
    }

    public function setTotalquantity(string $totalquantity): static
    {
        $this->totalquantity = $totalquantity;

        return $this;
    }

    public function getTotalcost(): ?string
    {
        return $this->totalcost;
    }

    public function setTotalcost(string $totalcost): static
    {
        $this->totalcost = $totalcost;

        return $this;
    }

    public function getActualcapitalgain(): ?string
    {
        return $this->actualcapitalgain;
    }

    public function setActualcapitalgain(string $actualcapitalgain): static
    {
        $this->actualcapitalgain = $actualcapitalgain;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): static
    {
        // set the owning side of the relation if necessary
        if ($client->getHasWallet() !== $this) {
            $client->setHasWallet($this);
        }

        $this->client = $client;

        return $this;
    }

    public function getCryptoCurrency(): ?CryptoCurrency
    {
        return $this->cryptoCurrency;
    }

    public function setCryptoCurrency(?CryptoCurrency $cryptoCurrency): static
    {
        $this->cryptoCurrency = $cryptoCurrency;

        return $this;
    }

    public function getWallet(): ?string
    {
        return $this->Wallet;
    }

    public function setWallet(string $Wallet): static
    {
        $this->Wallet = $Wallet;

        return $this;
    }

    
        // Other getters and setters...
    
        /**
         * Initialize the wallet with a default balance of 500 euros.
         */
        public function initializeWithDefaultBalance(): void
        {
            // Assuming 'Wallet' property holds the balance
            $this->setWallet('500');
        }
    
        /**
         * Add a cryptocurrency to the wallet.
         * 
         * @param string $quantity The quantity of the cryptocurrency to add.
         * @param string $cost     The total cost of purchasing the cryptocurrency.
         */
        public function addCryptoCurrency(string $quantity, string $cost): void
        {
            // Update total quantity and total cost based on the purchased cryptocurrency
            $this->totalquantity += $quantity;
            $this->totalcost += $cost;
            
            // Calculate the new actual capital gain
            $this->actualcapitalgain = $this->calculateActualCapitalGain();
        }
    
        /**
         * Sell a cryptocurrency from the wallet.
         * 
         * @param string $quantity The quantity of the cryptocurrency to sell.
         * @param string $price    The selling price of the cryptocurrency.
         */
        public function sellCryptoCurrency(string $quantity, string $price): void
        {
            // Update total quantity based on the sold cryptocurrency
            $this->totalquantity -= $quantity;
            
            // Calculate the new actual capital gain
            $this->actualcapitalgain = $this->calculateActualCapitalGain();
        }
    
        /**
         * Calculate the actual capital gain.
         * 
         * @return string The calculated actual capital gain.
         */
        private function calculateActualCapitalGain(): string
        {
            // Calculate the new actual capital gain based on the total quantity, total cost, and current prices
            // Replace this with your actual calculation logic
            return '100'; // Example return value
        }
    }
    
