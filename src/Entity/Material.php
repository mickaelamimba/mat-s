<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=MaterialRepository::class)
 */
class Material
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
     *
     * @ORM\Column(name="imeiNumber",type="string", unique="true", options={"fixed" = true}, nullable=false)
     */
    private $imeiNumber;

    /**
     * @ORM\Column(type="string", length=35, nullable=true)
     */
    private $marque;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="string",columnDefinition="ENUM('READY','STOCK','DESTROY','BEINGDESTROY')")
     */
    private $state;

    /**
     * @ORM\Column(type="string",columnDefinition="ENUM('UNLOCK','TOBLOCK','UNUSABLE')")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="material")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Confiscation::class, inversedBy="materials")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $confiscation;

    /**
     * @ORM\ManyToOne(targetEntity=Ready::class, inversedBy="materiel")
     */
    private $ready;






        public function __construct()
        {
            $this->setCreatedAt(new \DateTime());
            $this->setUpdatedAt(new \DateTime());
            $this->setState('STOCK');
            if($this->getStatus()==='UNUSABLE'||$this->getStatus() ==='TOBLOCK'){
                $this->setState('BEINGDESTROY');
            }

        }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getImeiNumber(): ?string
    {
        return $this->imeiNumber;
    }

    public function setImeiNumber(?string $imeiNumber): self
    {
        $this->imeiNumber = $imeiNumber;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }


    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getConfiscation(): ?Confiscation
    {
        return $this->confiscation;
    }

    public function setConfiscation(?Confiscation $confiscation): self
    {
        $this->confiscation = $confiscation;

        return $this;
    }

    public function getReady(): ?Ready
    {
        return $this->ready;
    }

    public function setReady(?Ready $ready): self
    {
        $this->ready = $ready;

        return $this;
    }







}
