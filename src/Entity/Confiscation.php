<?php

namespace App\Entity;

use App\Repository\ConfiscationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ConfiscationRepository::class)
 */
class Confiscation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *@Assert\NotBlank()
     * @Assert\Length(min=3)
     * @ORM\Column(name="pvNumber",type="string", unique="true", options={"fixed" = true}, nullable=false)
     * @ORM\Column( length=50)
     */
    private $pvNumber;

    /**
     * @Assert\Count(min=1)
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity=Material::class, mappedBy="confiscation",orphanRemoval=true, cascade={"persist"})
     */
    private $materials;

    public function __construct()
    {
        $this->materials = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }
    public function __toString(): string
    {
        return $this->getPvNumber() ;
    }

    public function getPvNumber(): ?string
    {
        return $this->pvNumber;
    }

    public function setPvNumber(string $pvNumber): self
    {
        $this->pvNumber = $pvNumber;

        return $this;
    }

    /**
     * @return Collection|Material[]
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(Material $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
            $material->setConfiscation($this);
        }

        return $this;
    }

    public function removeMaterial(Material $material): self
    {
        if ($this->materials->removeElement($material)) {
            // set the owning side to null (unless already changed)
            if ($material->getConfiscation() === $this) {
                $material->setConfiscation(null);
            }
        }

        return $this;
    }






}
