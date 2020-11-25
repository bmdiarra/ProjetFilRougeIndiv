<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilRepository;
use App\DataPersister\ProfilPersister;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * @ApiResource(
 *      routePrefix="/admin",
 *      attributes={"pagination_items_per_page"=7},
 *      collectionOperations={
 *          "get_admin_profils":{
 *              "method": "get",
 *              "path": "/profils",
 *              "normalization_context"={"groups":"admin_profil:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN'))",
 *          },
 *          "post_admin_profils":{
 *              "method": "post",
 *              "path": "/profils",
 *              "access_control"="(is_granted('ROLE_ADMIN'))",
 *          }
 *      },
 *      itemOperations={
 *          "get_admin_profils":{
 *              "method": "get",
 *              "path": "/profils/{id}",
 *              "normalization_context"={"groups":"admin_profil:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN'))",
 *          },
 *          "get_admin_profil_id_users":{
 *              "method": "get",
 *              "path": "/profil/{id}/users",
 *              "normalization_context"={"groups":"admin_profil_id_users:read"},
 *              "access_control"="(is_granted('ROLE_ADMIN'))",
 *          },
 *          "PUT":{
 *              "access_control"="(is_granted('ROLE_ADMIN'))",
 *          },
 *          "DELETE":{
 *              "access_control"="(is_granted('ROLE_ADMIN'))",
 *          }
 *      }
 * ),
 * @ApiFilter(BooleanFilter::class, properties={"isdeleted"}),
 * @UniqueEntity("libelle",message="La libelle ne doit pas etre repeter")
 * 
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"admin_profil:read","admin_profil_id_users:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"admin_profil:read","admin_profil_id_users:read"})
     * @Assert\NotBlank()
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * @Groups({"admin_profil_id_users:read"})
     */
    private $users;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $isdeleted;

    public function __construct()
    {
        $this->isdeleted = 0;
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }

    public function getIsdeleted(): ?bool
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(bool $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }

}
