<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "getcompetences":{
 *              "method":"get",
 *              "path":"/admin/competences",
 *          },
 *          "postcompetences":{
 *              "method":"post",
 *              "path":"/admin/competences",
 *          }
 *      },
 *      itemOperations={
 *          "getcompetencesid":{
 *              "method":"get",
 *              "path":"/admin/competences/{id}",
 *              "normalisation_context":{"groups":"competences:read"},
 *          },
 *          "putcompetencesid":{
 *              "method":"put",
 *              "path":"/admin/competences/id",
 *          },
 *          
 *      }
 * )
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"admin_grpscompetences_competences:read","competences:read"})
     * 
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="competences")
     */
    private $groupescompetences;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="competences")
     * @Groups({"competences:read"})
     */
    private $niveaux;

    /**
     * @ORM\ManyToOne(targetEntity=CompetencesValides::class, inversedBy="competences")
     */
    private $competencesvalides;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archivage;

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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(?bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }
}
