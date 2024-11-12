<?php

namespace App\Enums\User;

enum RoleEnum: string
{
    case CLIENT = 'client';
    case ADMIN = 'admin';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
