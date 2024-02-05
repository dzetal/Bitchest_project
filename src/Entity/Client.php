<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $temporypassword = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $solde = null;

    #[ORM\OneToOne(inversedBy: 'client', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Wallet $HasWallet = null;

    #[ORM\ManyToMany(targetEntity: Transaction::class, inversedBy: 'clients')]
    private Collection $ClientTransaction;

    #[ORM\OneToMany(mappedBy: 'stop', targetEntity: Wallet::class)]
    private Collection $ClientWallet;

    public function __construct()
    {
        $this->ClientTransaction = new ArrayCollection();
        $this->ClientWallet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getTemporypassword(): ?string
    {
        return $this->temporypassword;
    }

    public function setTemporypassword(string $temporypassword): static
    {
        $this->temporypassword = $temporypassword;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): static
    {
        $this->solde = $solde;

        return $this;
    }

    public function getHasWallet(): ?Wallet
    {
        return $this->HasWallet;
    }

    public function setHasWallet(Wallet $HasWallet): static
    {
        $this->HasWallet = $HasWallet;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getClientTransaction(): Collection
    {
        return $this->ClientTransaction;
    }

    public function addClientTransaction(Transaction $clientTransaction): static
    {
        if (!$this->ClientTransaction->contains($clientTransaction)) {
            $this->ClientTransaction->add($clientTransaction);
        }

        return $this;
    }

    public function removeClientTransaction(Transaction $clientTransaction): static
    {
        $this->ClientTransaction->removeElement($clientTransaction);

        return $this;
    }

    /**
     * @return Collection<int, Wallet>
     */
    public function getClientWallet(): Collection
    {
        return $this->ClientWallet;
    }

    public function addClientWallet(Wallet $clientWallet): static
    {
        if (!$this->ClientWallet->contains($clientWallet)) {
            $this->ClientWallet->add($clientWallet);
            $clientWallet->setStop($this);
        }

        return $this;
    }

    public function removeClientWallet(Wallet $clientWallet): static
    {
        if ($this->ClientWallet->removeElement($clientWallet)) {
            // set the owning side to null (unless already changed)
            if ($clientWallet->getStop() === $this) {
                $clientWallet->setStop(null);
            }
        }

        return $this;
    }
}
