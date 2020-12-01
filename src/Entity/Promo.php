<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PromoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "getpromos":{
 *              "method":"get",
 *              "path":"/admin/promo",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosprincipal":{
 *              "method":"get",
 *              "path":"/admin/promo/principal",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosapprenantsattente":{
 *              "method":"get",
 *              "path":"/admin/promo/apprenants/attente",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "postpromos":{
 *              "method":"post",
 *              "path":"/admin/promo",
 *          }
 *      },
 *      itemOperations={
 *          "getpromosid":{
 *              "method":"get",
 *              "path":"/admin/promo/{id}",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosidprincipal":{
 *              "method":"get",
 *              "path":"/admin/promo/{id}/principal",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosidprincipal":{
 *              "method":"get",
 *              "path":"/admin/promo/{id}/principal",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosidreferentiel":{
 *              "method":"get",
 *              "path":"/admin/promo/{id}/referentiel",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosidapprenantsattente":{
 *              "method":"get",
 *              "path":"/admin/promo/{id}/apprenants/attente",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosidapprenantsattente":{
 *              "method":"get",
 *              "path":"/admin/promo/{id}/groupes/{id2}/apprenants",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "getpromosidformateurs":{
 *              "method":"get",
 *              "path":"/admin/promo/{id}/formateurs",
 *              "normalization_context":{"groups":"get_promos:read"}
 *          },
 *          "putpromosid":{
 *              "method":"put",
 *              "path":"/admin/promo/{id}",
 *          },
 *          "putpromosidapprenants":{
 *              "method":"put",
 *              "path":"/admin/promo/{id}/apprenants",
 *          },
 *          "putpromosidapprenants":{
 *              "method":"put",
 *              "path":"/admin/promo/{id}/formateurs",
 *          },
 *          "putpromosidgroupesid":{
 *              "method":"put",
 *              "path":"/admin/promo/{id}/groupes/{id2}",
 *          }
 *      }
 * )
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isdeleted;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->competencesValides = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
        $this->isdeleted = 0 ;
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getIsdeleted(): ?bool
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(?bool $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
