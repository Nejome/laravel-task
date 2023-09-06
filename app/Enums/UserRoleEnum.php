<?php

namespace App\Enums;

enum UserRoleEnum:string
{
    case COORDINATOR = 'coordinator';
    case MANAGER = 'manager';
}
