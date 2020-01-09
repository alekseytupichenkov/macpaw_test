<?php

namespace App\Domain\Airplane\Enums;

use MabeEnum\EnumSet;

class LandSet extends EnumSet
{
    public function __construct(iterable $enumerators = null)
    {
        parent::__construct(Land::class, $enumerators);
    }

    /**
     * @param Land[] $lands
     */
    public function hasAtLastOne(iterable $lands): bool
    {
        foreach ($lands as $land) {
            if ($this->has($land)) {
                return true;
            }
        }

        return false;
    }
}
