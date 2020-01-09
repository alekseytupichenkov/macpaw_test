<?php

namespace App\Domain\Airplane;

use App\Domain\Airplane\Enums\LandSet;

interface Landable
{
    public function getSuitableLandingLands(): LandSet;
}
