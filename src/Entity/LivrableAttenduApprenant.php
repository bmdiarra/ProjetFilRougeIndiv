<?php

namespace App\Entity;

use App\Repository\LivrableAttenduApprenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivrableAttenduApprenantRepository::class)
 */
class LivrableAttenduApprenant
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
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=LivrableAttendu::class, inversedBy="livrableAttenduApprenants")
     */
    private $livrablesattendus;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="livrableAttenduApprenants")
     */
    private $apprenants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getLivrablesattendus(): ?LivrableAttendu
    {
        return $this->livrablesattendus;
    }

    public function setLivrablesattendus(?LivrableAttendu $livrablesattendus): self
    {
        $this->livrablesattendus = $livrablesattendus;

        return $this;
    }

    public function getApprenants(): ?Apprenant
    {
        return $this->apprenants;
    }

    public function setApprenants(?Apprenant $apprenants): self
    {
        $this->apprenants = $apprenants;

        return $this;
    }
}
