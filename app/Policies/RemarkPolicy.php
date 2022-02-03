<?php

namespace App\Policies;

use App\Models\Remark;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RemarkPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function view(User $user, Remark $remark)
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

    public function update(User $user, Remark $remark)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

    public function delete(User $user, Remark $remark)
    {
        if($user->hasRole(['admin', 'operations'])) {
            return true;
        }
    }

}
