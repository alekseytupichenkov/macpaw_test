<?php

namespace App\Domain;

use App\Domain\Airplane\Enums\Weather;

interface WeatherProviderInterface
{
    public function getCurrentWeather(): Weather;
}
