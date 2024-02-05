<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $purchaseprice = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $Amount = null;

    #[ORM\ManyToOne(inversedBy: 'HasTransaction')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CryptoCurrency $cryptoCurrency = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'UserTransaction')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Client::class, mappedBy: 'ClientTransaction')]
    private Collection $clients;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPurchaseprice(): ?string
    {
        return $this->purchaseprice;
    }

    public function setPurchaseprice(string $purchaseprice): static
    {
        $this->purchaseprice = $purchaseprice;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(string $Amount): static
    {
        $this->Amount = $Amount;

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


    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->addClientTransaction($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            $client->removeClientTransaction($this);
        }

        return $this;
    }
}
