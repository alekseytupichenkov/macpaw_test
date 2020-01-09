<?php

namespace App\Domain\Airplane\Collections;

use App\Domain\Airplane\AirplaneModelInterface;

class AirplaneModelCollection
{
    /**
     * @var AirplaneModelInterface[]
     */
    private $airplaneModels = [];

    /**
     * @param AirplaneModelInterface[] $airplaneModels
     */
    public function __construct(iterable $airplaneModels)
    {
        foreach ($airplaneModels as $airplaneModel) {
            $this->addAirplaneModel($airplaneModel);
        }
    }

    private function addAirplaneModel(AirplaneModelInterface $airplaneModel)
    {
        $this->airplaneModels[$airplaneModel->getModelName()] = $airplaneModel;
    }

    public function getModelNames(): array
    {
        return array_keys($this->airplaneModels);
    }

    public function get($modelName): AirplaneModelInterface
    {
        return $this->airplaneModels[$modelName];
    }
}
