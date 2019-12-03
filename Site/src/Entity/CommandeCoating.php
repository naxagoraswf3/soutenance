<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeCoatingRepository")
 */
class CommandeCoating
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
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $application;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $formulation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $provenance;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(message="La quantité ne peut être négative")
     */
    private $quantite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $complement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fonction", inversedBy="commandeCoatings")
     */
    private $fonction;

    public function __construct()
    {
        $this->fonction = new ArrayCollection();
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getResine(): ?string
    {
        return $this->resine;
    }

    public function setResine(string $resine): self
    {
        $this->resine = $resine;

        return $this;
    }

    public function getApplication(): ?string
    {
        return $this->application;
    }

    public function setApplication(string $application): self
    {
        $this->application = $application;

        return $this;
    }

    public function getFormulation(): ?string
    {
        return $this->formulation;
    }

    public function setFormulation(string $formulation): self
    {
        $this->formulation = $formulation;

        return $this;
    }

    public function getProvenance(): ?string
    {
        return $this->provenance;
    }

    public function setProvenance(string $provenance): self
    {
        $this->provenance = $provenance;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(string $complement): self
    {
        $this->complement = $complement;

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
     * @return Collection|fonction[]
     */
    public function getFonction(): Collection
    {
        return $this->fonction;
    }

    public function addFonction(Fonction $fonction): self
    {
        if (!$this->fonction->contains($fonction)) {
            $this->fonction[] = $fonction;
        }

        return $this;
    }

    public function removeFonction(Fonction $fonction): self
    {
        if ($this->fonction->contains($fonction)) {
            $this->fonction->removeElement($fonction);
        }

        return $this;
    }

     public function __toString(){
        return $this->nom;
    }
}
