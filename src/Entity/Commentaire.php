<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createAt;

    /**
     * @ORM\OneToMany(targetEntity=FilDiscution::class, mappedBy="commentaires")
     */
    private $filDiscutions;

    /**
     * @ORM\OneToMany(targetEntity=Formateur::class, mappedBy="commentaires")
     */
    private $formateurs;

    public function __construct()
    {
        $this->filDiscutions = new ArrayCollection();
        $this->formateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @return Collection|FilDiscution[]
     */
    public function getFilDiscutions(): Collection
    {
        return $this->filDiscutions;
    }

    public function addFilDiscution(FilDiscution $filDiscution): self
    {
        if (!$this->filDiscutions->contains($filDiscution)) {
            $this->filDiscutions[] = $filDiscution;
            $filDiscution->setCommentaires($this);
        }

        return $this;
    }

    public function removeFilDiscution(FilDiscution $filDiscution): self
    {
        if ($this->filDiscutions->removeElement($filDiscution)) {
            // set the owning side to null (unless already changed)
            if ($filDiscution->getCommentaires() === $this) {
                $filDiscution->setCommentaires(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs[] = $formateur;
            $formateur->setCommentaires($this);
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        if ($this->formateurs->removeElement($formateur)) {
            // set the owning side to null (unless already changed)
            if ($formateur->getCommentaires() === $this) {
                $formateur->setCommentaires(null);
            }
        }

        return $this;
    }
}
