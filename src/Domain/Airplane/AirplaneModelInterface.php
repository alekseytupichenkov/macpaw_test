<?php

namespace App\Domain\Airplane;

interface AirplaneModelInterface extends Flyable, Takeoffable, Landable
{
    public function getModelName(): string;
}
