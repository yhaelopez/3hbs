<?php

namespace App\Policies;

use App\Models\Airport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AirportPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function view(User $user, Airport $airport)
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

    public function update(User $user, Airport $airport)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function delete(User $user, Airport $airport)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

}
