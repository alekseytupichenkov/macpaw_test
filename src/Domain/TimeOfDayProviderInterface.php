<?php

namespace App\Domain;

use App\Domain\Airplane\Enums\TimeOfDay;

interface TimeOfDayProviderInterface
{
    public function getCurrentTimeOfDay(): TimeOfDay;
}
