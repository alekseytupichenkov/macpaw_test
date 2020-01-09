<?php

namespace Tests\Unit\Domain\Airplane\Models;

use App\Domain\Airplane\Enums\Land;
use App\Domain\Airplane\Enums\TimeOfDay;
use App\Domain\Airplane\Enums\Weather;
use App\Domain\Airplane\Models\AeropraktA24;
use PHPUnit\Framework\TestCase;

class AeropraktA24Test extends TestCase
{
    private $airplane;

    public function setUp()
    {
        $this->airplane = new AeropraktA24();
    }

    /**
     * @test
     */
    public function shouldMayTakeoffAndLandOnAnyLands()
    {
        $this->assertTrue($this->airplane->getSuitableLandingLands()->has(Land::RUNWAY));
        $this->assertTrue($this->airplane->getSuitableLandingLands()->has(Land::WATER));
        $this->assertTrue($this->airplane->getSuitableTakeoffLands()->has(Land::RUNWAY));
        $this->assertTrue($this->airplane->getSuitableTakeoffLands()->has(Land::WATER));
    }

    /**
     * @test
     */
    public function shouldMayFlyOnlyAtDaytimeAndGoodWeather()
    {
        $this->assertTrue($this->airplane->getSuitableTimeOfDay()->has(TimeOfDay::DAYTIME));
        $this->assertFalse($this->airplane->getSuitableTimeOfDay()->has(TimeOfDay::NIGHTTIME));
        $this->assertTrue($this->airplane->getSuitableWeather()->has(Weather::SUNNY));
        $this->assertFalse($this->airplane->getSuitableWeather()->has(Weather::RAINY));
        $this->assertFalse($this->airplane->getSuitableWeather()->has(Weather::RAGNAROK));
    }
}
