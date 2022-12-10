<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $AmmoType = null;

    #[ORM\OneToMany(mappedBy: 'Type', targetEntity: Weapons::class)]
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

    public function getAmmoType(): ?string
    {
        return $this->AmmoType;
    }

    public function setAmmoType(string $AmmoType): self
    {
        $this->AmmoType = $AmmoType;

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
            $weapon->setType($this);
        }

        return $this;
    }

    public function removeWeapon(Weapons $weapon): self
    {
        if ($this->weapons->removeElement($weapon)) {
            // set the owning side to null (unless already changed)
            if ($weapon->getType() === $this) {
                $weapon->setType(null);
            }
        }

        return $this;
    }
}
