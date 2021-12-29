<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Material::class, mappedBy="type", orphanRemoval=true)
     */
    private $material;

    public function __construct()
    {
        $this->material = new ArrayCollection();

    }

    public function __toString(): string
    {
        return $this->getName() ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Material[]
     */
    public function getMaterial(): Collection
    {
        return $this->material;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->material->contains($material)) {
            $this->material[] = $material;
            $material->setType($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        if ($this->material->removeElement($material)) {
            // set the owning side to null (unless already changed)
            if ($material->getType() === $this) {
                $material->setType(null);
            }
        }

        return $this;
    }


}
