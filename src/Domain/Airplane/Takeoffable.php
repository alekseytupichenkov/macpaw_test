<?php

namespace App\Domain\Airplane;

use App\Domain\Airplane\Enums\LandSet;

interface Takeoffable
{
    public function getSuitableTakeoffLands(): LandSet;
}
