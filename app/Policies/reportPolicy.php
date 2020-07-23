<?php

namespace App\Policies;

use App\Report;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class reportPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        if ($user->role == '2'){
            return true;
        }else{
            return false;
        }
    }


    public function store(User $user)
    {
        if ($user->role == '2'){
            return true;
        }else{
            return false;
        }
    }


    public function getDownload(User $user)
    {
        if ($user->role == '2'){
            return true;
        }else{
            return false;
        }
    }


}
