<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DossierRepository")
 * 
 * @UniqueEntity("number")
 */
class Dossier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="number", type="string", length=6, unique=true)
     * @Assert\Type(type={"digit"})
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $surname;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active = true;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DossierAddress", mappedBy="dossier")
     */
    private $dossierAddresses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DossierCard", mappedBy="dossier")
     */
    private $dossierCards;

    public function __construct()
    {
        $this->dossierAddresses = new ArrayCollection();
        $this->dossierCards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection|DossierAddress[]
     */
    public function getDossierAddresses(): Collection
    {
        return $this->dossierAddresses;
    }

    public function addDossierAddress(DossierAddress $dossierAddress): self
    {
        if (!$this->dossierAddresses->contains($dossierAddress)) {
            $this->dossierAddresses[] = $dossierAddress;
            $dossierAddress->setDossier($this);
        }

        return $this;
    }

    public function removeDossierAddress(DossierAddress $dossierAddress): self
    {
        if ($this->dossierAddresses->contains($dossierAddress)) {
            $this->dossierAddresses->removeElement($dossierAddress);
            // set the owning side to null (unless already changed)
            if ($dossierAddress->getDossier() === $this) {
                $dossierAddress->setDossier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DossierCard[]
     */
    public function getDossierCards(): Collection
    {
        return $this->dossierCards;
    }

    public function addDossierCard(DossierCard $dossierCard): self
    {
        if (!$this->dossierCards->contains($dossierCard)) {
            $this->dossierCards[] = $dossierCard;
            $dossierCard->setDossier($this);
        }

        return $this;
    }

    public function removeDossierCard(DossierCard $dossierCard): self
    {
        if ($this->dossierCards->contains($dossierCard)) {
            $this->dossierCards->removeElement($dossierCard);
            // set the owning side to null (unless already changed)
            if ($dossierCard->getDossier() === $this) {
                $dossierCard->setDossier(null);
            }
        }

        return $this;
    }
}
