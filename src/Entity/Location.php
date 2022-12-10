<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?int $Season = null;

    #[ORM\OneToMany(mappedBy: 'LocationDrop', targetEntity: Weapons::class)]
    private Collection $weapons;

    public function __construct()
    {
        $this->weapons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->Season;
    }

    public function setSeason(int $Season): self
    {
        $this->Season = $Season;

        return $this;
    }

    /**
     * @return Collection<int, Weapons>
     */
    public function getWeapons(): Collection
    {
        return $this->weapons;
    }

    public function addWeapon(Weapons $weapon): self
    {
        if (!$this->weapons->contains($weapon)) {
            $this->weapons->add($weapon);
            $weapon->setLocationDrop($this);
        }

        return $this;
    }

    public function removeWeapon(Weapons $weapon): self
    {
        if ($this->weapons->removeElement($weapon)) {
            // set the owning side to null (unless already changed)
            if ($weapon->getLocationDrop() === $this) {
                $weapon->setLocationDrop(null);
            }
        }

        return $this;
    }
}
