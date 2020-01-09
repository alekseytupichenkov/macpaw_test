<?php

namespace App\Domain\Model;

use App\Domain\Airplane\AirplaneModelInterface;

class Airplane
{
    protected $id;

    // todo: probably better to map models using DBAL types
    protected $model;

    protected $title;

    protected $hangar;

    // todo: need to create enum for statuses.
    protected $status = 'fly';

    public function __construct(AirplaneModelInterface $airplaneModel)
    {
        $this->model = $airplaneModel->getModelName();
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getHangar(): ?Hangar
    {
        return $this->hangar;
    }

    public function setHangar(?Hangar $hangar): self
    {
        if (null !== $hangar) {
            $this->status = 'landed';
        } else {
            $this->status = 'fly';
        }
        $this->hangar = $hangar;

        return $this;
    }
}
