<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeCoatingRepository")
 */
class CommandeCoating {

    const RESINE = [
        0 => "Aqueuse",
        1 => "Solutée",
        2 => "100%",
        3 => "Autre"];

    const FORMULATION = [
        0 => "Formulation à 100%",
        1 => "Slurry concentré à diluer"];

    const PROVENANCE = [
        0 => "Formulation dans résine fournie",
        1 => "Résine Naxagoras compatible"];
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
     * @ORM\Column(type="integer")
     */
    private $resine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $application;

    /**
     * @ORM\Column(type="integer")
     */
    private $formulation;

    /**
     * @ORM\Column(type="integer")
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

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autrefonction;

    private $captchaCode;

    public function __construct() {
        $this->fonction = new ArrayCollection();
    }

    public function getId():  ? int {
        return $this->id;
    }

    public function getNom() :  ? string {
        return $this->nom;
    }

    public function setNom(string $nom) : self{
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom():  ? string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom) : self{
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail():  ? string {
        return $this->mail;
    }

    public function setMail(string $mail) : self{
        $this->mail = $mail;

        return $this;
    }

    public function getResine():  ? int {
        return $this->resine;
    }

    public function setResine(int $resine) : self{
        $this->resine = $resine;

        return $this;
    }

    public function getApplication():  ? string {
        return $this->application;
    }

    public function setApplication(string $application) : self{
        $this->application = $application;

        return $this;
    }

    public function getFormulation():  ? int {
        return $this->formulation;
    }

    public function setFormulation(int $formulation) : self{
        $this->formulation = $formulation;

        return $this;
    }

    public function getProvenance():  ? int {
        return $this->provenance;
    }

    public function setProvenance(int $provenance) : self{
        $this->provenance = $provenance;

        return $this;
    }

    public function getQuantite():  ? int {
        return $this->quantite;
    }

    public function setQuantite(int $quantite) : self{
        $this->quantite = $quantite;

        return $this;
    }

    public function getComplement():  ? string {
        return $this->complement;
    }

    public function setComplement(string $complement) : self{
        $this->complement = $complement;

        return $this;
    }

    public function getCreatedAt():  ? \DateTimeInterface {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at) : self{
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|fonction[]
     */
    public function getFonction(): Collection {
        return $this->fonction;
    }

    public function addFonction(Fonction $fonction): self {
        if (!$this->fonction->contains($fonction)) {
            $this->fonction[] = $fonction;
        }

        return $this;
    }

    public function removeFonction(Fonction $fonction): self {
        if ($this->fonction->contains($fonction)) {
            $this->fonction->removeElement($fonction);
        }

        return $this;
    }

    public function getAutrefonction():  ? string {
        return $this->autrefonction;
    }

    public function setAutrefonction( ? string $autrefonction) : self{
        $this->autrefonction = $autrefonction;

        return $this;
    }
    public function getCaptchaCode() {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode) {
        $this->captchaCode = $captchaCode;

    }

    public function __toString() {
        return $this->nom;
    }
}
