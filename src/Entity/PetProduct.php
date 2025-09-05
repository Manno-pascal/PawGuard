<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\PetProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PetProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class PetProduct
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'petProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pet $pet = null;

    #[ORM\ManyToOne(inversedBy: 'petProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?\DateTime $buyDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPet(): ?Pet
    {
        return $this->pet;
    }

    public function setPet(?Pet $pet): static
    {
        $this->pet = $pet;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getBuyDate(): ?\DateTime
    {
        return $this->buyDate;
    }

    public function setBuyDate(\DateTime $buyDate): static
    {
        $this->buyDate = $buyDate;

        return $this;
    }
}
