<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *      },
 *      itemOperations={
 *      }
 * )
 */
class Apprenant extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity=LivrableAttenduApprenant::class, mappedBy="apprenants")
     */
    protected $livrableAttenduApprenants;

    /**
     * @ORM\OneToMany(targetEntity=ApprenantLivrablePartiel::class, mappedBy="apprenants")
     */
    protected $apprenantLivrablePartiels;

    /**
     * @ORM\ManyToOne(targetEntity=CompetencesValides::class, inversedBy="apprenants")
     */
    protected $competencesvalides;

    /**
     * @ORM\OneToMany(targetEntity=BriefApprenant::class, mappedBy="apprenants")
     */
    protected $briefApprenants;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, inversedBy="apprenants")
     */
    protected $groupes;

    public function __construct()
    {
        parent::__construct();
        $this->livrableAttenduApprenants = new ArrayCollection();
        $this->apprenantLivrablePartiels = new ArrayCollection();
        $this->briefApprenants = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|LivrableAttenduApprenant[]
     */
    public function getLivrableAttenduApprenants(): Collection
    {
        return $this->livrableAttenduApprenants;
    }

    public function addLivrableAttenduApprenant(LivrableAttenduApprenant $livrableAttenduApprenant): self
    {
        if (!$this->livrableAttenduApprenants->contains($livrableAttenduApprenant)) {
            $this->livrableAttenduApprenants[] = $livrableAttenduApprenant;
            $livrableAttenduApprenant->setApprenants($this);
        }

        return $this;
    }

    public function removeLivrableAttenduApprenant(LivrableAttenduApprenant $livrableAttenduApprenant): self
    {
        if ($this->livrableAttenduApprenants->removeElement($livrableAttenduApprenant)) {
            // set the owning side to null (unless already changed)
            if ($livrableAttenduApprenant->getApprenants() === $this) {
                $livrableAttenduApprenant->setApprenants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ApprenantLivrablePartiel[]
     */
    public function getApprenantLivrablePartiels(): Collection
    {
        return $this->apprenantLivrablePartiels;
    }

    public function addApprenantLivrablePartiel(ApprenantLivrablePartiel $apprenantLivrablePartiel): self
    {
        if (!$this->apprenantLivrablePartiels->contains($apprenantLivrablePartiel)) {
            $this->apprenantLivrablePartiels[] = $apprenantLivrablePartiel;
            $apprenantLivrablePartiel->setApprenants($this);
        }

        return $this;
    }

    public function removeApprenantLivrablePartiel(ApprenantLivrablePartiel $apprenantLivrablePartiel): self
    {
        if ($this->apprenantLivrablePartiels->removeElement($apprenantLivrablePartiel)) {
            // set the owning side to null (unless already changed)
            if ($apprenantLivrablePartiel->getApprenants() === $this) {
                $apprenantLivrablePartiel->setApprenants(null);
            }
        }

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

    /**
     * @return Collection|BriefApprenant[]
     */
    public function getBriefApprenants(): Collection
    {
        return $this->briefApprenants;
    }

    public function addBriefApprenant(BriefApprenant $briefApprenant): self
    {
        if (!$this->briefApprenants->contains($briefApprenant)) {
            $this->briefApprenants[] = $briefApprenant;
            $briefApprenant->setApprenants($this);
        }

        return $this;
    }

    public function removeBriefApprenant(BriefApprenant $briefApprenant): self
    {
        if ($this->briefApprenants->removeElement($briefApprenant)) {
            // set the owning side to null (unless already changed)
            if ($briefApprenant->getApprenants() === $this) {
                $briefApprenant->setApprenants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        $this->groupes->removeElement($groupe);

        return $this;
    }
}
