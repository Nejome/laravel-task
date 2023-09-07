<?php

namespace App\Enums;

enum UserRoleEnum:string
{
    case COORDINATOR = 'coordinator';
    case MANAGER = 'manager';

    public function name(): string
    {
        return match ($this) {
            UserRoleEnum::MANAGER => 'مدير',
            UserRoleEnum::COORDINATOR => 'منسق',
        };
    }
}
