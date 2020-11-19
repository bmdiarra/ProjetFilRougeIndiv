<?php

namespace App\Entity;

use App\Repository\PromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=CompetencesValides::class, mappedBy="promos")
     */
    private $competencesValides;

    /**
     * @ORM\OneToMany(targetEntity=Referentiel::class, mappedBy="promos")
     */
    private $referentiels;

    /**
     * @ORM\ManyToOne(targetEntity=Chat::class, inversedBy="promos")
     */
    private $chats;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="promos")
     */
    private $groupes;

    /**
     * @ORM\ManyToOne(targetEntity=BriefMaPromo::class, inversedBy="promos")
     */
    private $briefmapromos;

    public function __construct()
    {
        $this->competencesValides = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CompetencesValides[]
     */
    public function getCompetencesValides(): Collection
    {
        return $this->competencesValides;
    }

    public function addCompetencesValide(CompetencesValides $competencesValide): self
    {
        if (!$this->competencesValides->contains($competencesValide)) {
            $this->competencesValides[] = $competencesValide;
            $competencesValide->addPromo($this);
        }

        return $this;
    }

    public function removeCompetencesValide(CompetencesValides $competencesValide): self
    {
        if ($this->competencesValides->removeElement($competencesValide)) {
            $competencesValide->removePromo($this);
        }

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
            $referentiel->setPromos($this);
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        if ($this->referentiels->removeElement($referentiel)) {
            // set the owning side to null (unless already changed)
            if ($referentiel->getPromos() === $this) {
                $referentiel->setPromos(null);
            }
        }

        return $this;
    }

    public function getChats(): ?Chat
    {
        return $this->chats;
    }

    public function setChats(?Chat $chats): self
    {
        $this->chats = $chats;

        return $this;
    }

    public function getGroupes(): ?Groupe
    {
        return $this->groupes;
    }

    public function setGroupes(?Groupe $groupes): self
    {
        $this->groupes = $groupes;

        return $this;
    }

    public function getBriefmapromos(): ?BriefMaPromo
    {
        return $this->briefmapromos;
    }

    public function setBriefmapromos(?BriefMaPromo $briefmapromos): self
    {
        $this->briefmapromos = $briefmapromos;

        return $this;
    }
}
