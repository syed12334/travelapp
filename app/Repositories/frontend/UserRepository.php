<?php

namespace App\Repositories\frontend;
use App\Models\User;    
class UserRepository
{
    public $users;
    public function __construct(User $user)
    {
        $this->users = $user;
    }
    /* Get all users */
    public function getAllUsers() {
        return $this->users->get();
    }
    /* Store Users */
    public function storeUser($data) {
        return $this->users->create($data);
    }
}
