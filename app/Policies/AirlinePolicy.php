<?php

namespace App\Policies;

use App\Models\Airline;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AirlinePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function view(User $user, Airline $airline)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function create(User $user)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function update(User $user, Airline $airline)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function delete(User $user, Airline $airline)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

}
