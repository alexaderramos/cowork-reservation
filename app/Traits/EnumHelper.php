<?php

namespace App\Traits;

trait EnumHelper
{
    /**
     * Get the values of the enum.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
