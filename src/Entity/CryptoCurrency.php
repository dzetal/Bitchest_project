<?php

namespace App\Entity;

use App\Repository\CryptoCurrencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CryptoCurrencyRepository::class)]
class CryptoCurrency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $symbol = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $currentprice = null;

    #[ORM\OneToMany(mappedBy: 'cryptoCurrency', targetEntity: Transaction::class)]
    private Collection $HasTransaction;

    #[ORM\OneToMany(mappedBy: 'cryptoCurrency', targetEntity: Wallet::class)]
    private Collection $HasWallet;

    public function __construct()
    {
        $this->HasTransaction = new ArrayCollection();
        $this->HasWallet = new ArrayCollection();
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

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): static
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCurrentprice(): ?string
    {
        return $this->currentprice;
    }

    public function setCurrentprice(string $currentprice): static
    {
        $this->currentprice = $currentprice;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getHasTransaction(): Collection
    {
        return $this->HasTransaction;
    }

    public function addHasTransaction(Transaction $hasTransaction): static
    {
        if (!$this->HasTransaction->contains($hasTransaction)) {
            $this->HasTransaction->add($hasTransaction);
            $hasTransaction->setCryptoCurrency($this);
        }

        return $this;
    }

    public function removeHasTransaction(Transaction $hasTransaction): static
    {
        if ($this->HasTransaction->removeElement($hasTransaction)) {
            // set the owning side to null (unless already changed)
            if ($hasTransaction->getCryptoCurrency() === $this) {
                $hasTransaction->setCryptoCurrency(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Wallet>
     */
    public function getHasWallet(): Collection
    {
        return $this->HasWallet;
    }

    public function addHasWallet(Wallet $hasWallet): static
    {
        if (!$this->HasWallet->contains($hasWallet)) {
            $this->HasWallet->add($hasWallet);
            $hasWallet->setCryptoCurrency($this);
        }

        return $this;
    }

    public function removeHasWallet(Wallet $hasWallet): static
    {
        if ($this->HasWallet->removeElement($hasWallet)) {
            // set the owning side to null (unless already changed)
            if ($hasWallet->getCryptoCurrency() === $this) {
                $hasWallet->setCryptoCurrency(null);
            }
        }

        return $this;
    }
}
