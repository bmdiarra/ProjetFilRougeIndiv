<?php

namespace App\Entity;

use App\Entity\Groupe;
use App\Entity\Formateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *          "get_formateurs":{
 *              "method": "get",
 *              "path": "/formateurs",
 *              "normalization_context"={"groups":"formateur_apprenant:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_CM'))",
 *          },
 *          "post_formateurs":{
 *              "method": "post",
 *              "route_name":"postFormateurs",
 *              "path": "/formateurs",
 *              "deserialize"=false
 *          }
 *      },
 *      itemOperations={
 *          "get_formateur_id":{
 *              "method": "get",
 *              "path": "/formateurs/{id}",
 *              "normalization_context"={"groups":"formateur_formateur:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          },
 *          "put_formateurs":{
 *              "method": "put",
 *              "route_name":"putFormateurs",
 *              "path": "/formateurs/{id}",
 *              "access_control"="(is_granted('ROLE_ADMIN'))",
 *              "deserialize"=false
 *          },
 *      }
 * )
 */
class Formateur extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="formateurs")
     */
    protected $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="formateurs")
     */
    protected $groupes;

    public function __construct()
    {
        parent::__construct();
        $this->groupes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaires(): ?Commentaire
    {
        return $this->commentaires;
    }

    public function setCommentaires(?Commentaire $commentaires): self
    {
        $this->commentaires = $commentaires;

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
            $groupe->addFormateur($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeFormateur($this);
        }

        return $this;
    }
}
