<?php

namespace App\Entity;

use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\VeterinarianRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VeterinarianRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Veterinarian
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    /**
     * @var Collection<int, VaccinationRecord>
     */
    #[ORM\OneToMany(targetEntity: VaccinationRecord::class, mappedBy: 'veterinarian')]
    private Collection $vaccination;

    public function __construct()
    {
        $this->vaccination = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection<int, VaccinationRecord>
     */
    public function getVaccination(): Collection
    {
        return $this->vaccination;
    }

    public function addVaccination(VaccinationRecord $vaccination): static
    {
        if (!$this->vaccination->contains($vaccination)) {
            $this->vaccination->add($vaccination);
            $vaccination->setVeterinarian($this);
        }

        return $this;
    }

    public function removeVaccination(VaccinationRecord $vaccination): static
    {
        if ($this->vaccination->removeElement($vaccination)) {
            // set the owning side to null (unless already changed)
            if ($vaccination->getVeterinarian() === $this) {
                $vaccination->setVeterinarian(null);
            }
        }

        return $this;
    }
}
