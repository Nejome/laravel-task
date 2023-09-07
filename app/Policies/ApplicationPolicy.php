<?php

namespace App\Policies;

use App\Enums\ApplicationActionEnum;
use App\Enums\UserRoleEnum;
use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApplicationPolicy
{
    public function viewApplicationsReport(User $user): bool
    {
        return $user->role == UserRoleEnum::COORDINATOR;
    }

    public function coordinatorAction(User $user, Application $application): bool
    {
        return $user->role == UserRoleEnum::COORDINATOR && $application->coordinator_action == ApplicationActionEnum::PENDING;
    }

    public function managerAction(User $user, Application $application): bool
    {
        return $user->role == UserRoleEnum::MANAGER && $application->coordinator_action == ApplicationActionEnum::ACCEPTED;
    }
}
