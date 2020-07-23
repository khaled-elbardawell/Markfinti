<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class managerPolicy
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



    public function create(User $user)
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

    public function block(User $user)
    {
        if ($user->role == '1'){
            return true;
        }else{
            return false;
        }
    }

    public function unblock(User $user)
    {
        if ($user->role == '1'){
            return true;
        }else{
            return false;
        }
    }

    public function viewBlock(User $user){
        if ($user->role == '1'){
            return true;
        }else{
            return false;
        }
    }




    public function edit(User $user)
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


    public function viewAnyClient(User $user)
    {
        if ($user->role == '3'){
            return false;
        }else{
            return true;
        }
    }



    public function createClient(User $user)
    {
        if ($user->role == '2'){
            return true;
        }else{
            return false;
        }
    }

    public function storeClient(User $user)
    {
        if ($user->role == '2'){
            return true;
        }else{
            return false;
        }
    }


    public function updateClient(User $user)
    {
        if ($user->role == '3'){
            return false;
        }else{
            return true;
        }
    }

    public function editClient(User $user)
    {
        if ($user->role == '3'){
            return false;
        }else{
            return true;
        }
    }


}
