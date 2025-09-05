<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 40)]
    private ?string $type = null;

    /**
     * @var Collection<int, PetProduct>
     */
    #[ORM\OneToMany(targetEntity: PetProduct::class, mappedBy: 'product', orphanRemoval: true)]
    private Collection $petProducts;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand = null;

    public function __construct()
    {
        $this->petProducts = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, PetProduct>
     */
    public function getPetProducts(): Collection
    {
        return $this->petProducts;
    }

    public function addPetProduct(PetProduct $petProduct): static
    {
        if (!$this->petProducts->contains($petProduct)) {
            $this->petProducts->add($petProduct);
            $petProduct->setProduct($this);
        }

        return $this;
    }

    public function removePetProduct(PetProduct $petProduct): static
    {
        if ($this->petProducts->removeElement($petProduct)) {
            // set the owning side to null (unless already changed)
            if ($petProduct->getProduct() === $this) {
                $petProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }
}
