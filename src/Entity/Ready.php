<?php

namespace App\Entity;

use App\Repository\ReadyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReadyRepository::class)
 */
class Ready
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nigend;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $userName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $loanDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $loanReturnDate;

    /**
     * @ORM\OneToMany(targetEntity=Material::class, mappedBy="ready")
     */
    private $materiel;

    public function __construct()
    {
        $this->materiel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNigend(): ?int
    {
        return $this->nigend;
    }

    public function setNigend(?int $nigend): self
    {
        $this->nigend = $nigend;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getLoanDate(): ?\DateTimeInterface
    {
        return $this->loanDate;
    }

    public function setLoanDate(?\DateTimeInterface $loanDate): self
    {
        $this->loanDate = $loanDate;

        return $this;
    }

    public function getLoanReturnDate(): ?\DateTimeInterface
    {
        return $this->loanReturnDate;
    }

    public function setLoanReturnDate(?\DateTimeInterface $loanReturnDate): self
    {
        $this->loanReturnDate = $loanReturnDate;

        return $this;
    }

    /**
     * @return Collection|Material[]
     */
    public function getMateriel(): Collection
    {
        return $this->materiel;
    }

    public function addMateriel(Material $materiel): self
    {
        if (!$this->materiel->contains($materiel)) {
            $this->materiel[] = $materiel;
            $materiel->setReady($this);
        }

        return $this;
    }

    public function removeMateriel(Material $materiel): self
    {
        if ($this->materiel->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getReady() === $this) {
                $materiel->setReady(null);
            }
        }

        return $this;
    }
}
