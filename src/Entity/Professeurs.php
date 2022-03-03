<?php

namespace App\Entity;

use App\Repository\ProfesseursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfesseursRepository::class)
 */
class Professeurs
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
    private $nomProfesseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomProfesseur;

    /**
     * @ORM\OneToMany(targetEntity=Classes::class, mappedBy="professeurs", orphanRemoval=true)
     */
    private $classe;

    public function __construct()
    {
        $this->classe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProfesseur(): ?string
    {
        return $this->nomProfesseur;
    }

    public function setNomProfesseur(string $nomProfesseur): self
    {
        $this->nomProfesseur = $nomProfesseur;

        return $this;
    }

    public function getPrenomProfesseur(): ?string
    {
        return $this->prenomProfesseur;
    }

    public function setPrenomProfesseur(string $prenomProfesseur): self
    {
        $this->prenomProfesseur = $prenomProfesseur;

        return $this;
    }

    /**
     * @return Collection|Classes[]
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(Classes $classe): self
    {
        if (!$this->classe->contains($classe)) {
            $this->classe[] = $classe;
            $classe->setProfesseurs($this);
        }

        return $this;
    }

    public function removeClasse(Classes $classe): self
    {
        if ($this->classe->removeElement($classe)) {
            // set the owning side to null (unless already changed)
            if ($classe->getProfesseurs() === $this) {
                $classe->setProfesseurs(null);
            }
        }

        return $this;
    }
}
