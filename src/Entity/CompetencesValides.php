<?php

namespace App\Entity;

use App\Repository\CompetencesValidesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetencesValidesRepository::class)
 */
class CompetencesValides
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niveau1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niveau2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niveau3;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="competencesvalides")
     */
    private $apprenants;

    /**
     * @ORM\OneToMany(targetEntity=Competence::class, mappedBy="competencesvalides")
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Promo::class, inversedBy="competencesValides")
     */
    private $promos;

    /**
     * @ORM\OneToMany(targetEntity=Referentiel::class, mappedBy="competencesvalides")
     */
    private $referentiels;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->promos = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau1(): ?string
    {
        return $this->niveau1;
    }

    public function setNiveau1(?string $niveau1): self
    {
        $this->niveau1 = $niveau1;

        return $this;
    }

    public function getNiveau2(): ?string
    {
        return $this->niveau2;
    }

    public function setNiveau2(?string $niveau2): self
    {
        $this->niveau2 = $niveau2;

        return $this;
    }

    public function getNiveau3(): ?string
    {
        return $this->niveau3;
    }

    public function setNiveau3(?string $niveau3): self
    {
        $this->niveau3 = $niveau3;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
            $apprenant->setCompetencesvalides($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getCompetencesvalides() === $this) {
                $apprenant->setCompetencesvalides(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->setCompetencesvalides($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            // set the owning side to null (unless already changed)
            if ($competence->getCompetencesvalides() === $this) {
                $competence->setCompetencesvalides(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        $this->promos->removeElement($promo);

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiels(): Collection
    {
        return $this->referentiels;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiels->contains($referentiel)) {
            $this->referentiels[] = $referentiel;
            $referentiel->setCompetencesvalides($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->removeElement($referentiel)) {
            // set the owning side to null (unless already changed)
            if ($referentiel->getCompetencesvalides() === $this) {
                $referentiel->setCompetencesvalides(null);
            }
        }

        return $this;
    }
}
