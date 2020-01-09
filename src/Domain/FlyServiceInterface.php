<?php

namespace App\Domain;

use App\Domain\Model\Airplane;
use App\Domain\Model\Hangar;

interface FlyServiceInterface
{
    public function takeoff(Airplane $airplane);

    public function land(Airplane $airplane, Hangar $hangar);
}
