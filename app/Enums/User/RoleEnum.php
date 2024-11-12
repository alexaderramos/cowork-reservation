<?php

namespace App\Enums\User;

use App\Traits\EnumHelper;

enum RoleEnum: string
{
    use EnumHelper;

    case CLIENT = 'client';
    case ADMIN = 'admin';
}
