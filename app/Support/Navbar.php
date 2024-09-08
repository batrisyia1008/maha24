<?php

namespace App\Support;

use Illuminate\Support\Facades\Auth;

class Navbar
{
    public static function getNavUser()
    {
        $user = Auth::user();

        return [
            /*[
                'name'       => $user->name,
                'rolesNames' => $user->getRoleNames()->first(),
                'image'      => asset('apps/img/avatars/1.png'),
                'role'       => ['user'],
                'url'        => '',
            ],*/
        ];
    }
}
