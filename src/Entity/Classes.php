<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClassesRepository::class)
 */
class Classes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomClasse;

    /**
     * @ORM\ManyToOne(targetEntity=Professeurs::class, inversedBy="classe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professeurs;

    /**
     * @ORM\OneToMany(targetEntity=Eleves::class, mappedBy="classes", orphanRemoval=true)
     */
    private $eleve;

    public function __construct()
    {
        $this->eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClasse(): ?string
    {
        return $this->NomClasse;
    }

    public function setNomClasse(string $NomClasse): self
    {
        $this->NomClasse = $NomClasse;

        return $this;
    }

    public function getProfesseurs(): ?Professeurs
    {
        return $this->professeurs;
    }

    public function setProfesseurs(?Professeurs $professeurs): self
    {
        $this->professeurs = $professeurs;

        return $this;
    }

    /**
     * @return Collection|Eleves[]
     */
    public function getEleve(): Collection
    {
        return $this->eleve;
    }

    public function addEleve(Eleves $eleve): self
    {
        if (!$this->eleve->contains($eleve)) {
            $this->eleve[] = $eleve;
            $eleve->setClasses($this);
        }

        return $this;
    }

    public function removeEleve(Eleves $eleve): self
    {
        if ($this->eleve->removeElement($eleve)) {
            // set the owning side to null (unless already changed)
            if ($eleve->getClasses() === $this) {
                $eleve->setClasses(null);
            }
        }

        return $this;
    }
}
