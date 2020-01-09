<?php

namespace App\Domain\Airplane\Models;

use App\Domain\Airplane\AirplaneModelInterface;
use App\Domain\Airplane\Enums\Land;
use App\Domain\Airplane\Enums\LandSet;
use App\Domain\Airplane\Enums\TimeOfDay;
use App\Domain\Airplane\Enums\TimeOfDaySet;
use App\Domain\Airplane\Enums\Weather;
use App\Domain\Airplane\Enums\WeatherSet;

class CurtissNC4 implements AirplaneModelInterface
{
    public function getModelName(): string
    {
        return 'Curtiss NC-4';
    }

    public function getSuitableTakeoffLands(): LandSet
    {
        return new LandSet([
            Land::get(Land::WATER),
        ]);
    }

    public function getSuitableLandingLands(): LandSet
    {
        return new LandSet([
            Land::get(Land::WATER),
        ]);
    }

    public function getSuitableTimeOfDay(): TimeOfDaySet
    {
        return new TimeOfDaySet([
            TimeOfDay::get(TimeOfDay::DAYTIME),
        ]);
    }

    public function getSuitableWeather(): WeatherSet
    {
        return new WeatherSet([
            Weather::get(Weather::SUNNY),
        ]);
    }
}
