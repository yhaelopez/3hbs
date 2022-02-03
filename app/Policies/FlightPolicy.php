<?php

namespace App\Policies;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlightPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->hasRole(['admin'])) {
            return true;
        }
    }

    public function view(User $user, Flight $flight)
    {
        if($user->hasRole(['admin'])) {
            return true;
        }
    }

    public function create(User $user)
    {
        if($user->hasRole(['admin'])) {
            return true;
        }
    }

    public function update(User $user, Flight $flight)
    {
        if($user->hasRole(['admin'])) {
            return true;
        }
    }

    public function delete(User $user, Flight $flight)
    {
        if($user->hasRole(['admin'])) {
            return true;
        }
    }
}
