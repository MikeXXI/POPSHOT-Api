<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RessourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourceRepository::class)]
#[ApiResource(formats:'json')]
class Ressource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 45)]
    private ?string $auteur = null;

    #[ORM\ManyToMany(targetEntity: Entry::class, inversedBy: 'ressources_id')]
    private Collection $entry_id;

    public function __construct()
    {
        $this->entry_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection<int, Entry>
     */
    public function getEntryId(): Collection
    {
        return $this->entry_id;
    }

    public function addEntryId(Entry $entryId): self
    {
        if (!$this->entry_id->contains($entryId)) {
            $this->entry_id->add($entryId);
        }

        return $this;
    }

    public function removeEntryId(Entry $entryId): self
    {
        $this->entry_id->removeElement($entryId);

        return $this;
    }
}
