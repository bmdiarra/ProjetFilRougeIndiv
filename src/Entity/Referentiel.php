<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "getreferentiel":{
 *              "method"="get",
 *              "path":"/admin/referentiels",
 *              "normalization_context":{"groups":"get_referentiel:read"}
 *          },
 *          "getreferentielgrpescompetences":{
 *              "method"="get",
 *              "path":"/admin/referentiels/grpescompetences",
 *              "normalization_context":{"groups":"get_referentiel_grpescompetences:read"}
 *          },
 *          "postreferentiel":{
 *              "method"="post",
 *              "path":"/admin/referentiels",
 *          }
 *      },
 *      itemOperations={
 *          "getreferentielid":{
 *              "method"="get",
 *              "path":"/admin/referentiels/{id}",
 *              "normalization_context":{"groups":"get_referentiel:read"}
 *          },
 *          "getreferentielidgrpescompetencesid":{
 *              "method"="get",
 *              "route_name":"getreferentielidgrpescompetencesid",
 *              "path":"/admin/referentiels/{id}/grpescompetences/{id2}",
 *              "normalization_context":{"groups":"get_referentiel:read"}
 *          },
 *          "putreferentiel":{
 *              "method"="put",
 *              "path":"/admin/referentiels/{id}",
 *          }
 *      }
 * )
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"get_referentiel:read"})
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isdeleted;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="referentiels")
     * @Groups({"get_referentiel:read"})
     */
    private $groupecompetences;

    public function __construct(){
        $this->isdeleted = 0 ;
        $this->groupecompetences = new ArrayCollection();
    }

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

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupecompetences(): Collection
    {
        return $this->groupecompetences;
    }

    public function addGroupecompetence(GroupeCompetence $groupecompetence): self
    {
        if (!$this->groupecompetences->contains($groupecompetence)) {
            $this->groupecompetences[] = $groupecompetence;
        }

        return $this;
    }

    public function removeGroupecompetence(GroupeCompetence $groupecompetence): self
    {
        $this->groupecompetences->removeElement($groupecompetence);

        return $this;
    }
}
