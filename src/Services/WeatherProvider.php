<?php

namespace App\Services;

use App\Domain\Airplane\Enums\Weather;
use App\Domain\WeatherProviderInterface;

class WeatherProvider implements WeatherProviderInterface
{
    public function getCurrentWeather(): Weather
    {
        return Weather::get(Weather::SUNNY);
    }
}
