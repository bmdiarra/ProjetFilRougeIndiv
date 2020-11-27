<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "getgroupescompetences":{
 *              "method": "get",
 *              "path": "/admin/groupescompetences",
 *              "normalization_context"={"groups":"admin_grpscompetences:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          },
 *          "getgroupescompetencescompetences":{
 *              "method": "get",
 *              "path": "/admin/groupescompetences/competences",
 *              "normalization_context"={"groups":"admin_grpscompetences_competences:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          },
 *          "postgroupescompetences":{
 *              "method": "post",
 *              "path": "/admin/groupescompetences",
 *              "access_control"="(is_granted('ROLE_ADMIN') )",
 *          }
 *      },
 *      itemOperations={
 *          "getgroupescompetencesid":{
 *              "method": "get",
 *              "path": "/admin/groupescompetences/{id}",
 *              "normalization_context"={"groups":"admin_grpscompetences:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          },
 *          "getgroupescompetencesidcompetences":{
 *              "method": "get",
 *              "path": "/admin/groupescompetences/{id}/competences",
 *              "normalization_context"={"groups":"admin_grpscompetences_comptences:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          },
 *          "putgroupescompetencesid":{
 *              "method": "put",
 *              "path": "/admin/groupescompetences/{id}",
 *              "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          }
 *      }
 * )
 * 
 */
class GroupeCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"admin_grpscompetences_competences:read"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, mappedBy="groupescompetences")
     * @Groups({"admin_grpscompetences_competences:read"})
     */
    private $competences;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $competence->addGroupescompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeGroupescompetence($this);
        }

        return $this;
    }
}
