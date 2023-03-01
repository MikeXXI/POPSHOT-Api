<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntryRepository::class)]
#[ApiResource (formats:'json')]
class Entry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entry_title = null;

    #[ORM\Column(length: 255)]
    private ?string $entry_content = null;

    #[ORM\ManyToMany(targetEntity: Ressource::class, mappedBy: 'entry_id')]
    private Collection $ressources_id;

    public function __construct()
    {
        $this->ressources_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntryTitle(): ?string
    {
        return $this->entry_title;
    }

    public function setEntryTitle(string $entry_title): self
    {
        $this->entry_title = $entry_title;

        return $this;
    }

    public function getEntryContent(): ?string
    {
        return $this->entry_content;
    }

    public function setEntryContent(string $entry_content): self
    {
        $this->entry_content = $entry_content;

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessourcesId(): Collection
    {
        return $this->ressources_id;
    }

    public function addRessourcesId(Ressource $ressourcesId): self
    {
        if (!$this->ressources_id->contains($ressourcesId)) {
            $this->ressources_id->add($ressourcesId);
            $ressourcesId->addEntryId($this);
        }

        return $this;
    }

    public function removeRessourcesId(Ressource $ressourcesId): self
    {
        if ($this->ressources_id->removeElement($ressourcesId)) {
            $ressourcesId->removeEntryId($this);
        }

        return $this;
    }
}
