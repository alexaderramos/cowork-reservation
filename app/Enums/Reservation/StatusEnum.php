<?php

namespace App\Enums\Reservation;

use App\Traits\EnumHelper;

enum StatusEnum: string
{
    use EnumHelper;

    case PENDING = 'Pending';
    case ACCEPTED = 'Accepted';
    case REJECTED = 'Rejected';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
