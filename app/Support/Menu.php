<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;

class Menu
{
    public static function getMenuItems()
    {
        return [
            // MENU VENDOR
            [
                'header'     => __('Apps'),
                'role'       => ['admin'],
                'menus'      => [
                    [
                        'permission' => 'user-access',
                        'url'        => route('visitor.index'),
                        'active_on'  => 'visitor*',
                        'icon'       => 'tf-icons ti ti-mail',
                        'text'       => __('Visitor'),
                        'target'     => '',
                    ],
                ]
            ],

            // MENU TEMPLATE
            [
                'header'     => __('Apps'),
                'role'       => ['system'],
                'menus'      => [
                    [
                        'permission' => 'systems-access',
                        'url'        => '#',
                        'active_on'  => '',
                        'icon'       => 'tf-icons ti ti-mail',
                        'text'       => __('Level 1'),
                        'target'     => '',
                    ],
                    [
                        'permission' => 'systems-access',
                        'url'        => '#',
                        'active_on'  => '',
                        'icon'       => 'tf-icons ti ti-mail',
                        'text'       => __('Level 1'),
                        'target'     => '',
                        'sub'        => [
                            [
                                'permission' => 'systems-access',
                                'url'        => '',
                                'active_on'  => '',
                                'icon'       => 'tf-icons ti ti-mail',
                                'text'       => __('Level 2'),
                                'target'     => '',
                            ],
                        ]
                    ],
                    [
                        'permission' => 'systems-access',
                        'url'        => '#',
                        'active_on'  => '',
                        'icon'       => 'tf-icons ti ti-mail',
                        'text'       => __('Level 1'),
                        'target'     => '',
                        'sub'        => [
                            [
                                'permission' => 'systems-access',
                                'url'        => '#',
                                'active_on'  => '',
                                'icon'       => 'tf-icons ti ti-mail',
                                'text'       => __('Level 2'),
                                'target'     => '',
                                'sub2'       => [
                                    [
                                        'permission' => 'systems-access',
                                        'url'        => '#',
                                        'active_on'  => '',
                                        'icon'       => 'tf-icons ti ti-mail',
                                        'text'       => __('Level 3'),
                                        'target'     => '',
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'permission' => 'systems-access',
                        'url'        => '#',
                        'active_on'  => '',
                        'icon'       => 'tf-icons ti ti-mail',
                        'text'       => __('Level 1'),
                        'target'     => '#',
                        'sub'        => [
                            [
                                'permission' => 'systems-access',
                                'url'        => '#',
                                'active_on'  => '',
                                'icon'       => 'tf-icons ti ti-mail',
                                'text'       => __('Level 2'),
                                'target'     => '',
                                'sub2'       => [
                                    [
                                        'permission' => 'systems-access',
                                        'url'        => '#',
                                        'active_on'  => '',
                                        'icon'       => 'tf-icons ti ti-mail',
                                        'text'       => __('Level 3'),
                                        'target'     => '',
                                        'sub3'       => [
                                            [
                                                'permission' => 'systems-access',
                                                'url'        => '#',
                                                'active_on'  => '',
                                                'icon'       => 'tf-icons ti ti-mail',
                                                'text'       => __('Level 4'),
                                                'target'     => '',
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                ]
            ],
        ];
    }

    public static function setActiveMenuItem($segment, $urlLast)
    {

    }

}
