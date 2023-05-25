<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: utilisateur::class)]
    private Collection $util;

    public function __construct()
    {
        $this->util = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, utilisateur>
     */
    public function getUtil(): Collection
    {
        return $this->util;
    }

    public function addUtil(utilisateur $util): self
    {
        if (!$this->util->contains($util)) {
            $this->util->add($util);
            $util->setProjet($this);
        }

        return $this;
    }

    public function removeUtil(utilisateur $util): self
    {
        if ($this->util->removeElement($util)) {
            // set the owning side to null (unless already changed)
            if ($util->getProjet() === $this) {
                $util->setProjet(null);
            }
        }

        return $this;
    }
}
