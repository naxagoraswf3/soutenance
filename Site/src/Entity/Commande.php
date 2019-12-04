<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Polymere;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Methode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Masterbatch;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MFI;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(message="La quantité ne peut être négative")
     */
    private $Quantite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Complement;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fonction", inversedBy="commandes")
     */
    private $fonction;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autrefonction;


    protected $captchaCode;

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
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getPolymere(): ?string
    {
        return $this->Polymere;
    }

    public function setPolymere(string $Polymere): self
    {
        $this->Polymere = $Polymere;

        return $this;
    }

    public function getMethode(): ?string
    {
        return $this->Methode;
    }

    public function setMethode(string $Methode): self
    {
        $this->Methode = $Methode;

        return $this;
    }

    public function getMasterbatch(): ?string
    {
        return $this->Masterbatch;
    }

    public function setMasterbatch(string $Masterbatch): self
    {
        $this->Masterbatch = $Masterbatch;

        return $this;
    }

    public function getMFI(): ?string
    {
        return $this->MFI;
    }

    public function setMFI(string $MFI): self
    {
        $this->MFI = $MFI;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->Quantite;
    }

    public function setQuantite(int $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getComplement(): ?string
    {
        return $this->Complement;
    }

    public function setComplement(?string $Complement): self
    {
        $this->Complement = $Complement;

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
     * @return Collection|Fonction[]
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

    public function getAutrefonction(): ?string
    {
        return $this->autrefonction;
    }

    public function setAutrefonction(?string $autrefonction): self
    {
        $this->autrefonction = $autrefonction;

        return $this;
    }
    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;

    }

    public function __toString(){
        return $this->Nom;

    }

}
