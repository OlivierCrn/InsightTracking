<?php

namespace App\Entity;

use App\Repository\WeaponsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeaponsRepository::class)]
class Weapons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column]
    private ?int $UnlockAt = null;

    #[ORM\Column]
    private ?int $InsightDrop = null;

    #[ORM\Column]
    private ?int $Level = null;

    #[ORM\Column]
    private ?bool $Crafted = null;

    #[ORM\ManyToOne(inversedBy: 'weapons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $LocationDrop = null;

    #[ORM\ManyToOne(inversedBy: 'weapons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $Type = null;

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

    public function getUnlockAt(): ?int
    {
        return $this->UnlockAt;
    }

    public function setUnlockAt(int $UnlockAt): self
    {
        $this->UnlockAt = $UnlockAt;

        return $this;
    }

    public function getInsightDrop(): ?int
    {
        return $this->InsightDrop;
    }

    public function setInsightDrop(int $InsightDrop): self
    {
        $this->InsightDrop = $InsightDrop;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->Level;
    }

    public function setLevel(int $Level): self
    {
        $this->Level = $Level;

        return $this;
    }

    public function isCrafted(): ?bool
    {
        return $this->Crafted;
    }

    public function setCrafted(bool $Crafted): self
    {
        $this->Crafted = $Crafted;

        return $this;
    }

    public function getLocationDrop(): ?Location
    {
        return $this->LocationDrop;
    }

    public function setLocationDrop(?Location $LocationDrop): self
    {
        $this->LocationDrop = $LocationDrop;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->Type;
    }

    public function setType(?Type $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
