<?php

namespace App\Repositories\frontend;
use App\Models\User;
class LoginRepository
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}


