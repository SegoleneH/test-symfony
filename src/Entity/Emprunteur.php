<?php

namespace App\Entity;

use App\Repository\EmprunteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmprunteurRepository::class)]
class Emprunteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 190)]
    private ?string $nom = null;

    #[ORM\Column(length: 190)]
    private ?string $prenom = null;

    #[ORM\OneToOne(mappedBy: 'emprunteur', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $tel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setEmprunteur(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getEmprunteur() !== $this) {
            $user->setEmprunteur($this);
        }

        $this->user = $user;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }
}
