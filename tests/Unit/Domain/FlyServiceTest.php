<?php

namespace Tests\Unit\Domain;

use App\Domain\Airplane\Collections\AirplaneModelCollection;
use App\Domain\Airplane\Enums\Land;
use App\Domain\Airplane\Enums\TimeOfDay;
use App\Domain\Airplane\Enums\Weather;
use App\Domain\Airplane\Models\Boeing747;
use App\Domain\FlyService;
use App\Domain\Model\Airplane;
use App\Domain\Model\Hangar;
use App\Domain\Repository\AirplaneRepositoryInterface;
use App\Domain\TimeOfDayProviderInterface;
use App\Domain\WeatherProviderInterface;
use PHPUnit\Framework\MockObject\MockObject as MockObject;
use PHPUnit\Framework\TestCase;

class FlyServiceTest extends TestCase
{
    /**
     * @var AirplaneModelCollection|MockObject
     */
    private $airplaneModelCollection;

    /**
     * @var AirplaneRepositoryInterface|MockObject
     */
    private $airplaneRepository;

    /**
     * @var WeatherProviderInterface|MockObject
     */
    private $weatherProvider;

    /**
     * @var TimeOfDayProviderInterface|MockObject
     */
    private $timeOfDayProvider;

    /**
     * @var FlyService
     */
    private $flyService;

    public function setUp()
    {
        $this->airplaneModelCollection = $this->createMock(AirplaneModelCollection::class);
        $this->airplaneRepository = $this->createMock(AirplaneRepositoryInterface::class);
        $this->weatherProvider = $this->createMock(WeatherProviderInterface::class);
        $this->timeOfDayProvider = $this->createMock(TimeOfDayProviderInterface::class);

        $this->flyService = new FlyService(
            $this->airplaneModelCollection,
            $this->airplaneRepository,
            $this->weatherProvider,
            $this->timeOfDayProvider
        );
    }

    /**
     * @test
     */
    public function shouldTakeoffAirplane()
    {
        $model = new Boeing747();
        $airplane = new Airplane($model);
        $hangar = new Hangar();
        $hangar->addLand(Land::get(Land::RUNWAY));
        $hangar->addLand(Land::get(Land::WATER));
        $airplane->setHangar($hangar);

        $this->airplaneModelCollection
            ->expects($this->once())
            ->method('get')
            ->with($model->getModelName())
            ->willReturn($model);

        $this->weatherProvider
            ->expects($this->once())
            ->method('getCurrentWeather')
            ->willReturn(Weather::get(Weather::SUNNY));

        $this->timeOfDayProvider
            ->expects($this->once())
            ->method('getCurrentTimeOfDay')
            ->willReturn(TimeOfDay::get(TimeOfDay::DAYTIME));

        $this->flyService->takeoff($airplane);

        $this->assertEquals('fly', $airplane->getStatus());
        $this->assertEquals(null, $airplane->getHangar());
    }

    /**
     * @test
     */
    public function shouldLandAirplane()
    {
        $model = new Boeing747();
        $airplane = new Airplane($model);
        $hangar = new Hangar();
        $hangar->addLand(Land::get(Land::RUNWAY));
        $hangar->addLand(Land::get(Land::WATER));

        $this->airplaneModelCollection
            ->expects($this->once())
            ->method('get')
            ->with($model->getModelName())
            ->willReturn($model);

        $this->flyService->land($airplane, $hangar);

        $this->assertEquals('landed', $airplane->getStatus());
        $this->assertEquals($hangar, $airplane->getHangar());
    }

    // todo add unsuccessful test cases
}
