<?php

namespace App\Entity;

use App\Repository\FilDiscutionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilDiscutionRepository::class)
 */
class FilDiscution
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Commentaire::class, inversedBy="filDiscutions")
     */
    private $commentaires;

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
}
