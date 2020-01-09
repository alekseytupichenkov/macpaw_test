<?php

namespace App\Domain\Airplane\Enums;

use MabeEnum\Enum;
use MabeEnum\EnumSerializableTrait;
use Serializable;

class Land extends Enum implements Serializable
{
    use EnumSerializableTrait;

    const RUNWAY = 'runway';
    const WATER = 'water';
}
