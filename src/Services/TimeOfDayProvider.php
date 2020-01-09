<?php

namespace App\Services;

use App\Domain\Airplane\Enums\TimeOfDay;
use App\Domain\TimeOfDayProviderInterface;

class TimeOfDayProvider implements TimeOfDayProviderInterface
{
    public function getCurrentTimeOfDay(): TimeOfDay
    {
        return TimeOfDay::get(TimeOfDay::DAYTIME);
    }
}
