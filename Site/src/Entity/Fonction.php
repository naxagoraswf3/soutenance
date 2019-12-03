<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FonctionRepository")
 */
class Fonction
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
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", mappedBy="fonction")
     */
    private $commandes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CommandeCoating", mappedBy="fonction")
     */
    private $commandeCoatings;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->commandeCoatings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addFonction($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removeFonction($this);
        }

        return $this;
    }

    /**
     * @return Collection|CommandeCoating[]
     */
    public function getCommandeCoatings(): Collection
    {
        return $this->commandeCoatings;
    }

    public function addCommandeCoating(CommandeCoating $commandeCoating): self
    {
        if (!$this->commandeCoatings->contains($commandeCoating)) {
            $this->commandeCoatings[] = $commandeCoating;
            $commandeCoating->addFonction($this);
        }

        return $this;
    }

    public function removeCommandeCoating(CommandeCoating $commandeCoating): self
    {
        if ($this->commandeCoatings->contains($commandeCoating)) {
            $this->commandeCoatings->removeElement($commandeCoating);
            $commandeCoating->removeFonction($this);
        }

        return $this;
    }
}
