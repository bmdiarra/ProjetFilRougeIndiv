<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin"="Admin","formateur"="Formateur", "apprenant"="Apprenant", "cm"="Cm", "user"="User"})
 * @ApiResource(
 *  attributes={"pagination_items_per_page"=7},
 *   collectionOperations={
 *         "get_admin_users":{
 *              "method": "get",
 *              "path": "/admin/users",
 *              "normalization_context"={"groups":"admin_user:read"},
 *          },
 *   },
 *   itemOperations={
 *      "get_admin_users":{
 *              "method": "get",
 *              "path": "/admin/users/{id}",
 *              "normalization_context"={"groups":"admin_user:read"},
 *          },
 *   }
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"admin_user:read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     */
    protected $username;

    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    protected $password;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     */
    protected $profil;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    protected $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isdeleted;

    /**
     * @ORM\ManyToOne(targetEntity=Chat::class, inversedBy="users")
     */
    protected $chats;


    public function __construct()
    {
       // $this->profils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIsdeleted(): ?string
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(string $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

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

}
