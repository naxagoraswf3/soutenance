<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdditifRepository")
 */
class Additif
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeAdditif", mappedBy="id_additif", orphanRemoval=true)
     */
    private $commandeAdditifs;

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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
            $commandeAdditif->setIdAdditif($this);
        }

        return $this;
    }

    public function removeCommandeAdditif(CommandeAdditif $commandeAdditif): self
    {
        if ($this->commandeAdditifs->contains($commandeAdditif)) {
            $this->commandeAdditifs->removeElement($commandeAdditif);
            // set the owning side to null (unless already changed)
            if ($commandeAdditif->getIdAdditif() === $this) {
                $commandeAdditif->setIdAdditif(null);
            }
        }

        return $this;
    }
}
