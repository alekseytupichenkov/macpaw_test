<?php

namespace App\Domain\Airplane\Enums;

use MabeEnum\Enum;

class TimeOfDay extends Enum
{
    const DAYTIME = 'daytime';
    const NIGHTTIME = 'nighttime';
}
