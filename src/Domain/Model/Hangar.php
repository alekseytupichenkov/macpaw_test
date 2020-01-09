<?php

namespace App\Domain\Model;

use App\Domain\Airplane\Enums\Land;
use Doctrine\Common\Collections\ArrayCollection;

class Hangar
{
    private $id;

    private $title;

    private $lands = [];

    private $airplanes;

    public function __construct()
    {
        $this->airplanes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Land[]
     */
    public function getLands(): iterable
    {
        return $this->lands;
    }

    public function addLand(Land $land): self
    {
        $this->lands[] = $land;

        return $this;
    }

    public function removeLand(Land $land): self
    {
        if (false !== ($key = array_search($land, $this->lands))) {
            unset($this->lands[$key]);
        }

        return $this;
    }

    /**
     * @return Airplane[]
     */
    public function getAirplanes(): iterable
    {
        return $this->airplanes;
    }
}
