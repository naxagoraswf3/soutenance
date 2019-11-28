<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeAdditifRepository")
 */
class CommandeAdditif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="commandeAdditifs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_commande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Additif", inversedBy="commandeAdditifs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_additif;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCommande(): ?Commande
    {
        return $this->id_commande;
    }

    public function setIdCommande(?Commande $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getIdAdditif(): ?Additif
    {
        return $this->id_additif;
    }

    public function setIdAdditif(?Additif $id_additif): self
    {
        $this->id_additif = $id_additif;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
