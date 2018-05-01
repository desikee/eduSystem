<?php

namespace App\Policies;

use App\Model\Admin\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class test
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
