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

}
