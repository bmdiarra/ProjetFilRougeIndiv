<?php

namespace App\Entity;

use App\Repository\GroupeTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 */
class GroupeTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTag::class, inversedBy="groupeTags")
     */
    private $groupestags;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTag::class, mappedBy="groupestags")
     */
    private $groupeTags;

    public function __construct()
    {
        $this->groupestags = new ArrayCollection();
        $this->groupeTags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupestags(): Collection
    {
        return $this->groupestags;
    }

    public function addGroupestag(self $groupestag): self
    {
        if (!$this->groupestags->contains($groupestag)) {
            $this->groupestags[] = $groupestag;
        }

        return $this;
    }

    public function removeGroupestag(self $groupestag): self
    {
        $this->groupestags->removeElement($groupestag);

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupeTags(): Collection
    {
        return $this->groupeTags;
    }

    public function addGroupeTag(self $groupeTag): self
    {
        if (!$this->groupeTags->contains($groupeTag)) {
            $this->groupeTags[] = $groupeTag;
            $groupeTag->addGroupestag($this);
        }

        return $this;
    }

    public function removeGroupeTag(self $groupeTag): self
    {
        if ($this->groupeTags->removeElement($groupeTag)) {
            $groupeTag->removeGroupestag($this);
        }

        return $this;
    }
}
