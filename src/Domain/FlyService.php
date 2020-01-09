<?php

namespace App\Domain;

use App\Domain\Airplane\Collections\AirplaneModelCollection;
use App\Domain\Model\Airplane;
use App\Domain\Model\Hangar;
use App\Domain\Repository\AirplaneRepositoryInterface;

class FlyService implements FlyServiceInterface
{
    /**
     * @var AirplaneModelCollection
     */
    private $airplaneModelCollection;

    /**
     * @var AirplaneRepositoryInterface
     */
    private $airplaneRepository;

    /**
     * @var WeatherProviderInterface
     */
    private $weatherProvider;

    /**
     * @var TimeOfDayProviderInterface
     */
    private $timeOfDayProvider;

    public function __construct(
        AirplaneModelCollection $airplaneModelCollection,
        AirplaneRepositoryInterface $airplaneRepository,
        WeatherProviderInterface $weatherProvider,
        TimeOfDayProviderInterface $timeOfDayProvider
    ) {
        $this->airplaneModelCollection = $airplaneModelCollection;
        $this->airplaneRepository = $airplaneRepository;
        $this->weatherProvider = $weatherProvider;
        $this->timeOfDayProvider = $timeOfDayProvider;
    }

    public function takeoff(Airplane $airplane)
    {
        if ('landed' !== $airplane->getStatus()) {
            // todo: better to create separate error class and use it
            throw new \Exception('Airplane already fly');
        }

        $model = $this->airplaneModelCollection->get($airplane->getModel());

        if (!$model->getSuitableTakeoffLands()->hasAtLastOne($airplane->getHangar()->getLands())) {
            throw new \Exception('Hangar haven\'t suitable land for takeoff');
        }

        if (!$model->getSuitableWeather()->has($this->weatherProvider->getCurrentWeather())) {
            throw new \Exception('Weather is not suitable for fly');
        }

        if (!$model->getSuitableTimeOfDay()->has($this->timeOfDayProvider->getCurrentTimeOfDay())) {
            throw new \Exception('Time of day is not suitable for fly');
        }

        $airplane->setHangar(null);
        $this->airplaneRepository->save($airplane);
    }

    public function land(Airplane $airplane, Hangar $hangar)
    {
        if ('fly' !== $airplane->getStatus()) {
            throw new \Exception('Airplane already landed');
        }

        $model = $this->airplaneModelCollection->get($airplane->getModel());

        if (!$model->getSuitableLandingLands()->hasAtLastOne($hangar->getLands())) {
            throw new \Exception('Hangar haven\'t suitable land for takeoff');
        }

        $airplane->setHangar($hangar);
        $this->airplaneRepository->save($airplane);
    }
}
