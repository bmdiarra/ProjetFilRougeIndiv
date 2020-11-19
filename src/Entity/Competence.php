<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="competences")
     */
    private $groupescompetences;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="competences")
     */
    private $niveaux;

    /**
     * @ORM\ManyToOne(targetEntity=CompetencesValides::class, inversedBy="competences")
     */
    private $competencesvalides;

    public function __construct()
    {
        $this->groupescompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupescompetences(): Collection
    {
        return $this->groupescompetences;
    }

    public function addGroupescompetence(GroupeCompetence $groupescompetence): self
    {
        if (!$this->groupescompetences->contains($groupescompetence)) {
            $this->groupescompetences[] = $groupescompetence;
        }

        return $this;
    }

    public function removeGroupescompetence(GroupeCompetence $groupescompetence): self
    {
        $this->groupescompetences->removeElement($groupescompetence);

        return $this;
    }

    public function getNiveaux(): ?Niveau
    {
        return $this->niveaux;
    }

    public function setNiveaux(?Niveau $niveaux): self
    {
        $this->niveaux = $niveaux;

        return $this;
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
}
