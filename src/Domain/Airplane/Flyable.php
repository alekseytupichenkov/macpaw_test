<?php

namespace App\Domain\Airplane;

use App\Domain\Airplane\Enums\TimeOfDaySet;
use App\Domain\Airplane\Enums\WeatherSet;

interface Flyable
{
    public function getSuitableTimeOfDay(): TimeOfDaySet;

    public function getSuitableWeather(): WeatherSet;
}
