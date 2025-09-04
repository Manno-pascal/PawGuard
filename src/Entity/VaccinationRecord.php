<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\VaccinationRecordRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: VaccinationRecordRepository::class)]
#[Broadcast]
#[ORM\HasLifecycleCallbacks]
class VaccinationRecord
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTime $injectionDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $vaccinationDuration = null;

    #[ORM\Column]
    private ?int $injectionCount = null;

    #[ORM\Column]
    private ?int $totalInjectionCount = null;

    #[ORM\ManyToOne(inversedBy: 'vaccinationRecords')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pet $pet = null;

    #[ORM\ManyToOne(inversedBy: 'vaccination')]
    private ?Veterinarian $veterinarian = null;

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

    public function getInjectionDate(): ?\DateTime
    {
        return $this->injectionDate;
    }

    public function setInjectionDate(\DateTime $injectionDate): static
    {
        $this->injectionDate = $injectionDate;

        return $this;
    }

    public function getVaccinationDuration(): ?int
    {
        return $this->vaccinationDuration;
    }

    public function setVaccinationDuration(?int $vaccinationDuration): static
    {
        $this->vaccinationDuration = $vaccinationDuration;

        return $this;
    }

    public function getInjectionCount(): ?int
    {
        return $this->injectionCount;
    }

    public function setInjectionCount(int $injectionCount): static
    {
        $this->injectionCount = $injectionCount;

        return $this;
    }

    public function getTotalInjectionCount(): ?int
    {
        return $this->totalInjectionCount;
    }

    public function setTotalInjectionCount(int $totalInjectionCount): static
    {
        $this->totalInjectionCount = $totalInjectionCount;

        return $this;
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

    public function getVeterinarian(): ?Veterinarian
    {
        return $this->veterinarian;
    }

    public function setVeterinarian(?Veterinarian $veterinarian): static
    {
        $this->veterinarian = $veterinarian;

        return $this;
    }
}
