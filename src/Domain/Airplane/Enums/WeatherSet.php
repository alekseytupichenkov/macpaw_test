<?php

namespace App\Domain\Airplane\Enums;

use MabeEnum\EnumSet;

class WeatherSet extends EnumSet
{
    public function __construct(iterable $enumerators = null)
    {
        parent::__construct(Weather::class, $enumerators);
    }
}
