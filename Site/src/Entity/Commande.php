<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $complements;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeProduit", mappedBy="id_commande", orphanRemoval=true)
     */
    private $id_produit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeProduit", mappedBy="id_commande", orphanRemoval=true)
     */
    private $commandeProduits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeAdditif", mappedBy="id_commande", orphanRemoval=true)
     */
    private $commandeAdditifs;

    public function __construct()
    {
        $this->id_produit = new ArrayCollection();
        $this->commandeProduits = new ArrayCollection();
        $this->commandeAdditifs = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getComplements(): ?string
    {
        return $this->complements;
    }

    public function setComplements(?string $complements): self
    {
        $this->complements = $complements;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|CommandeProduit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->id_produit;
    }

    public function addIdProduit(CommandeProduit $idProduit): self
    {
        if (!$this->id_produit->contains($idProduit)) {
            $this->id_produit[] = $idProduit;
            $idProduit->setIdCommande($this);
        }

        return $this;
    }

    public function removeIdProduit(CommandeProduit $idProduit): self
    {
        if ($this->id_produit->contains($idProduit)) {
            $this->id_produit->removeElement($idProduit);
            // set the owning side to null (unless already changed)
            if ($idProduit->getIdCommande() === $this) {
                $idProduit->setIdCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommandeProduit[]
     */
    public function getCommandeProduits(): Collection
    {
        return $this->commandeProduits;
    }

    public function addCommandeProduit(CommandeProduit $commandeProduit): self
    {
        if (!$this->commandeProduits->contains($commandeProduit)) {
            $this->commandeProduits[] = $commandeProduit;
            $commandeProduit->setIdCommande($this);
        }

        return $this;
    }

    public function removeCommandeProduit(CommandeProduit $commandeProduit): self
    {
        if ($this->commandeProduits->contains($commandeProduit)) {
            $this->commandeProduits->removeElement($commandeProduit);
            // set the owning side to null (unless already changed)
            if ($commandeProduit->getIdCommande() === $this) {
                $commandeProduit->setIdCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CommandeAdditif[]
     */
    public function getCommandeAdditifs(): Collection
    {
        return $this->commandeAdditifs;
    }

    public function addCommandeAdditif(CommandeAdditif $commandeAdditif): self
    {
        if (!$this->commandeAdditifs->contains($commandeAdditif)) {
            $this->commandeAdditifs[] = $commandeAdditif;
            $commandeAdditif->setIdCommande($this);
        }

        return $this;
    }

    public function removeCommandeAdditif(CommandeAdditif $commandeAdditif): self
    {
        if ($this->commandeAdditifs->contains($commandeAdditif)) {
            $this->commandeAdditifs->removeElement($commandeAdditif);
            // set the owning side to null (unless already changed)
            if ($commandeAdditif->getIdCommande() === $this) {
                $commandeAdditif->setIdCommande(null);
            }
        }

        return $this;
    }
}
