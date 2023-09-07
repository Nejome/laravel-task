<?php

namespace App\Enums;

enum ApplicationActionEnum:string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function name(): string
    {
        return match ($this) {
            ApplicationActionEnum::PENDING => 'قيد الإنتظار',
            ApplicationActionEnum::ACCEPTED => 'مقبول',
            ApplicationActionEnum::REJECTED => 'مرفوض',
        };
    }
}
