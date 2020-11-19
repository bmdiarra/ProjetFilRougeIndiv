<?php

namespace App\Entity;

use App\Repository\ReferentielRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CompetencesValides::class, inversedBy="referentiels")
     */
    private $competencesvalides;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="referentiels")
     */
    private $promos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetencesvalides(): ?CompetencesValides
    {
        return $this->competencesvalides;
    }

    public function setCompetencesvalides(?CompetencesValides $competencesvalides): self
    {
        $this->competencesvalides = $competencesvalides;

        return $this;
    }

    public function getPromos(): ?Promo
    {
        return $this->promos;
    }

    public function setPromos(?Promo $promos): self
    {
        $this->promos = $promos;

        return $this;
    }
}
