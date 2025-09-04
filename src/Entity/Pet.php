<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\PetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PetRepository::class)]
#[Broadcast]
#[ORM\HasLifecycleCallbacks]
class Pet
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $animalType = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 10)]
    private ?string $sex = null;

    #[ORM\ManyToOne(inversedBy: 'pets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    /**
     * @var Collection<int, VaccinationRecord>
     */
    #[ORM\OneToMany(targetEntity: VaccinationRecord::class, mappedBy: 'pet', orphanRemoval: true)]
    private Collection $vaccinationRecords;

    public function __construct()
    {
        $this->vaccinationRecords = new ArrayCollection();
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

    public function getAnimalType(): ?string
    {
        return $this->animalType;
    }

    public function setAnimalType(string $animalType): static
    {
        $this->animalType = $animalType;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, VaccinationRecord>
     */
    public function getVaccinationRecords(): Collection
    {
        return $this->vaccinationRecords;
    }

    public function addVaccinationRecord(VaccinationRecord $vaccinationRecord): static
    {
        if (!$this->vaccinationRecords->contains($vaccinationRecord)) {
            $this->vaccinationRecords->add($vaccinationRecord);
            $vaccinationRecord->setPet($this);
        }

        return $this;
    }

    public function removeVaccinationRecord(VaccinationRecord $vaccinationRecord): static
    {
        if ($this->vaccinationRecords->removeElement($vaccinationRecord)) {
            // set the owning side to null (unless already changed)
            if ($vaccinationRecord->getPet() === $this) {
                $vaccinationRecord->setPet(null);
            }
        }

        return $this;
    }
}
