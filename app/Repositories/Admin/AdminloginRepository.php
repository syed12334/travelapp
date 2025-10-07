<?php

namespace App\Repositories\Admin;

use App\Models\Admin;

class AdminloginRepository
{
    protected $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
}
