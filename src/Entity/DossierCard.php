<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DossierCardRepository")
 */
class DossierCard
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="dossierCards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    /**
     * @ORM\Column(type="string", length=16, options={"fixed" = true})
     * @Assert\Type(type={"digit"})
     * @Assert\Length(
     *      min = 16,
     *      max = 16,
     *      exactMessage = "The card number should have exactly {{ limit }} digits.",
     *      allowEmptyString = true
     * )
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\Type(type={"digit"})
     * @Assert\Length(
     *      min = 1,
     *      max = 4,
     *      allowEmptyString = true
     * )
     */
    private $cvv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }
}
