<?php

namespace App\Domain\Airplane\Enums;

use MabeEnum\EnumSet;

class TimeOfDaySet extends EnumSet
{
    public function __construct(iterable $enumerators = null)
    {
        parent::__construct(TimeOfDay::class, $enumerators);
    }
}
