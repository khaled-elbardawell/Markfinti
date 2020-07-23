<?php

namespace App\Policies;

use App\Progress;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class progressPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        if ($user->role == '1'){
            return true;
        }else{
            return false;
        }
    }






    public function update(User $user)
    {
        if ($user->role == '1'){
            return true;
        }else{
            return false;
        }
    }


    public function delete(User $user)
    {
        if ($user->role == '1'){
            return true;
        }else{
            return false;
        }
    }


    public function store(User $user)
    {
        if ($user->role == '1'){
            return true;
        }else{
            return false;
        }
    }


}
