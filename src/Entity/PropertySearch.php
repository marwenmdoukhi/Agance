<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min="10", max="400")
     */
    private $minSurface;

    /**
     * @var ArrayCollection
     */
    private $options;

    /**
     * PropertySearch constructor.
     */
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param int $max_price
     * @return PropertySearch
     */
    public function setMaxPrice(int $max_price): PropertySearch
    {
        $this->maxPrice = $max_price;
        return $this;
    }

    /**
     * @param int $min_surface
     * @return PropertySearch
     */
    public function setMinSurface(int $min_surface): PropertySearch
    {
        $this->minSurface = $min_surface;
        return $this;
    }

    /**
     * @param ArrayCollection $options
     * @return PropertySearch
     */
    public function setOptions(ArrayCollection $options): PropertySearch
    {
        $this->options = $options;
        return $this;
    }
}