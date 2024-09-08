<?php

namespace App\Support;

class LogOut
{
    public static function LogOut()
    {
        return [
            [
                'role'          => ['system', 'admin'],
                'dropdown-item' => [
                    'formUrl' => route('logout'),
                    'formId'  => 'admin-logout-form',
                ],
            ],

            /*[
                'role'          => ['organizer'],
                'dropdown-item' => [
                    'formUrl' => route('organizer.auth.destroy'),
                    'formId'  => 'organizer-logout-form',
                ],
            ],

            [
                'role'          => ['vendor'],
                'dropdown-item' => [
                    'formUrl' => route('vendor.auth.destroy'),
                    'formId'  => 'vendor-logout-form',
                ],
            ],

            [
                'role'          => ['user'],
                'dropdown-item' => [
                    'formUrl' => route('logout') ,
                    'formId'  => 'user-logout-form',
                ],
            ],*/
        ];
    }
}
