<?php

namespace App\Entity;

use App\Repository\ApprenantLivrablePartielRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApprenantLivrablePartielRepository::class)
 */
class ApprenantLivrablePartiel
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
    private $etat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $delai;

    /**
     * @ORM\ManyToOne(targetEntity=LivrablePartiel::class, inversedBy="apprenantLivrablePartiels")
     */
    private $livrablespartiels;

    /**
     * @ORM\OneToOne(targetEntity=FilDiscution::class, cascade={"persist", "remove"})
     */
    private $fildiscussion;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="apprenantLivrablePartiels")
     */
    private $apprenants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDelai(): ?\DateTimeInterface
    {
        return $this->delai;
    }

    public function setDelai(?\DateTimeInterface $delai): self
    {
        $this->delai = $delai;

        return $this;
    }

    public function getLivrablespartiels(): ?LivrablePartiel
    {
        return $this->livrablespartiels;
    }

    public function setLivrablespartiels(?LivrablePartiel $livrablespartiels): self
    {
        $this->livrablespartiels = $livrablespartiels;

        return $this;
    }

    public function getFildiscussion(): ?FilDiscution
    {
        return $this->fildiscussion;
    }

    public function setFildiscussion(?FilDiscution $fildiscussion): self
    {
        $this->fildiscussion = $fildiscussion;

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
