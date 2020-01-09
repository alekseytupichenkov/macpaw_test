<?php

namespace App\Domain\Airplane\Models;

use App\Domain\Airplane\AirplaneModelInterface;
use App\Domain\Airplane\Enums\Land;
use App\Domain\Airplane\Enums\LandSet;
use App\Domain\Airplane\Enums\TimeOfDay;
use App\Domain\Airplane\Enums\TimeOfDaySet;
use App\Domain\Airplane\Enums\Weather;
use App\Domain\Airplane\Enums\WeatherSet;

class Boeing747 implements AirplaneModelInterface
{
    public function getModelName(): string
    {
        return 'Boeing 747';
    }

    public function getSuitableTakeoffLands(): LandSet
    {
        return new LandSet([
            Land::get(Land::RUNWAY),
        ]);
    }

    public function getSuitableLandingLands(): LandSet
    {
        return new LandSet([
            Land::get(Land::RUNWAY),
        ]);
    }

    public function getSuitableTimeOfDay(): TimeOfDaySet
    {
        return new TimeOfDaySet([
            TimeOfDay::get(TimeOfDay::DAYTIME),
            TimeOfDay::get(TimeOfDay::NIGHTTIME),
        ]);
    }

    public function getSuitableWeather(): WeatherSet
    {
        return new WeatherSet([
            Weather::get(Weather::RAINY),
            Weather::get(Weather::SUNNY),
            Weather::get(Weather::RAGNAROK),
        ]);
    }
}
