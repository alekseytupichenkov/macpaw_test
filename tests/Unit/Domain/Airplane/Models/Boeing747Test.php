<?php

namespace Tests\Unit\Domain\Airplane\Models;

use App\Domain\Airplane\Enums\Land;
use App\Domain\Airplane\Enums\TimeOfDay;
use App\Domain\Airplane\Enums\Weather;
use App\Domain\Airplane\Models\Boeing747;
use PHPUnit\Framework\TestCase;

class Boeing747Test extends TestCase
{
    private $airplane;

    public function setUp()
    {
        $this->airplane = new Boeing747();
    }

    /**
     * @test
     */
    public function shouldMayTakeoffAndLandOnlyOnRunway()
    {
        $this->assertTrue($this->airplane->getSuitableLandingLands()->has(Land::RUNWAY));
        $this->assertFalse($this->airplane->getSuitableLandingLands()->has(Land::WATER));
        $this->assertTrue($this->airplane->getSuitableTakeoffLands()->has(Land::RUNWAY));
        $this->assertFalse($this->airplane->getSuitableTakeoffLands()->has(Land::WATER));
    }

    /**
     * @test
     */
    public function shouldMayFlyAtAnyTimeOfDayAndWeather()
    {
        $this->assertTrue($this->airplane->getSuitableTimeOfDay()->has(TimeOfDay::DAYTIME));
        $this->assertTrue($this->airplane->getSuitableTimeOfDay()->has(TimeOfDay::NIGHTTIME));
        $this->assertTrue($this->airplane->getSuitableWeather()->has(Weather::SUNNY));
        $this->assertTrue($this->airplane->getSuitableWeather()->has(Weather::RAINY));
        $this->assertTrue($this->airplane->getSuitableWeather()->has(Weather::RAGNAROK));
    }
}
