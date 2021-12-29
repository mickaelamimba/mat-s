<?php

namespace App\Search;

use App\Entity\Confiscation;
use App\Entity\Material;
use App\Entity\Type;

class SearchMaterial
{
    /**
     * @var string
     */
    private  $q='';
    /**
     * @var int
     */
    private  $page=1;

    /**
     * @var Confiscation
     */
    private $pvNumber;
    /**
     * @var string
     */
    private $imeiNumber;
    /**
     * @var string
     */
    private $marque;
    /**
     * @var Type[]
     */
    private $type =[] ;

    /**
     * @var $state[]
     */
    private $state =[];
    /**
     * @var $status[]
     */
    private $status =[];

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return string
     */
    public function getQ(): string
    {
        return $this->q;
    }

    /**
     * @param string $q
     */
    public function setQ(string $q): void
    {
        $this->q = $q;
    }







    /**
     * @return string
     */
    public function getPvNumber(): string
    {
        return $this->pvNumber;
    }

    /**
     * @param string $pvNumber
     * @return SearchMaterial
     */
    public function setPvNumber(string $pvNumber): SearchMaterial
    {
        $this->pvNumber = $pvNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getImeiNumber(): string
    {
        return $this->imeiNumber;
    }

    /**
     * @param string $imeiNumber
     * @return SearchMaterial
     */
    public function setImeiNumber(string $imeiNumber): SearchMaterial
    {
        $this->imeiNumber = $imeiNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getMarque(): string
    {
        return $this->marque;
    }

    /**
     * @param string $marque
     * @return SearchMaterial
     */
    public function setMarque(string $marque): SearchMaterial
    {
        $this->marque = $marque;
        return $this;
    }

    /**
     * @return array
     */
    public function getType(): array
    {
        return $this->type;
    }

    /**
     * @param array $type
     * @return SearchMaterial
     */
    public function setType(array $type): SearchMaterial
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getState(): array
    {
        return $this->state;
    }

    /**
     * @param array $state
     * @return SearchMaterial
     */
    public function setState(array $state): SearchMaterial
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @param array $status
     * @return SearchMaterial
     */
    public function setStatus(array $status): SearchMaterial
    {
        $this->status = $status;
        return $this;
    }


}