<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class projectPolicy
{
    use HandlesAuthorization;



    public function create(User $user)
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


    public function edit(User $user)
    {
        if ($user->role == '3'){
            return false;
        }else{
            return true;
        }
    }

    public function update(User $user)
    {
        if ($user->role == '3'){
            return false;
        }else{
            return true;
        }
    }

    public function details(User $user)
    {
        if ($user->role == '3'){
            return false;
        }else{
            return true;
        }
    }



    public function transaction(User $user)
    {
        if ($user->role == '3'){
            return false;
        }else{
            return true;
        }
    }

    public function addTransaction(User $user)
    {
        if ($user->role == '2'){
            return true;
        }else{
            return false;
        }
    }



    public function message(User $user)
    {
        if ($user->role == '1'){
            return false;
        }else{
            return true;
        }
    }


}
