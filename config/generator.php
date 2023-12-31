<?php

return [
    /**
     * If any input file(image) as default will used options below.
     */
    'image' => [
        /**
         * Path for store the image.
         *
         * avaiable options:
         * 1. public
         * 2. storage
         */
        'path' => 'storage',

        /**
         * Will used if image is nullable and default value is null.
         */
        'default' => 'https://via.placeholder.com/350?text=No+Image+Avaiable',

        /**
         * Crop the uploaded image using intervention image.
         */
        'crop' => true,

        /**
         * When set to true the uploaded image aspect ratio will still original.
         */
        'aspect_ratio' => true,

        /**
         * Crop image size.
         */
        'width' => 500,
        'height' => 500,
    ],

    'format' => [
        /**
         * Will used to first year on select, if any column type year.
         */
        'first_year' => 1900,

        /**
         * If any date column type will cast and display used this format, but for input date still will used Y-m-d format.
         *
         * another most common format:
         * - M d Y
         * - d F Y
         * - Y m d
         */
        'date' => 'd/m/Y',

        /**
         * If any input type month will cast and display used this format.
         */
        'month' => 'm/Y',

        /**
         * If any input type time will cast and display used this format.
         */
        'time' => 'H:i',

        /**
         * If any datetime column type or datetime-local on input, will cast and display used this format.
         */
        'datetime' => 'd/m/Y H:i',

        /**
         * Limit string on index view for any column type text or longtext.
         */
        'limit_text' => 100,
    ],

    /**
     * It will used for generator to manage and showing menus on sidebar views.
     *
     * Example:
     * [
     *   'header' => 'Main',
     *
     *   // All permissions in menus[] and submenus[]
     *   'permissions' => ['test view'],
     *
     *   menus' => [
     *       [
     *          'title' => 'Main Data',
     *          'icon' => '<i class="bi bi-collection-fill"></i>',
     *          'route' => null,
     *
     *          // permission always null when isset submenus
     *          'permission' => null,
     *
     *          // All permissions on submenus[] and will empty[] when submenus equals to []
     *          'permissions' => ['test view'],
     *
     *          'submenus' => [
     *                 [
     *                     'title' => 'Tests',
     *                     'route' => '/tests',
     *                     'permission' => 'test view'
     *                  ]
     *               ],
     *           ],
     *       ],
     *  ],
     *
     * This code below always changes when you use a generator and maybe you must lint or format the code.
     */
    'sidebars' => [
        [
            'header' => 'Pengajuans',
            'permissions' => [
                'pengajuan view'
            ],
            'menus' => [
                [
                    'title' => 'Daftar Pengajuan Cuti',
                    'icon' => '<i class="bi bi-calendar-week"></i>',
                    'route' => '/pengajuans',
                    'permission' => 'pengajuan view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],
        [
            'header' => 'Employees',
            'permissions' => [
                'karyawan view'
            ],
            'menus' => [
                [
                    'title' => 'Karyawan',
                    'icon' => '<i class="bi bi-people"></i>',
                    'route' => '/employees',
                    'permission' => 'karyawan view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],
        [
            'header' => 'Main',
            'permissions' => [
                'departemen view',
                'jabatan view'
            ],
            'menus' => [
                [
                    'title' => 'Master Data',
                    'icon' => '<i class="bi bi-collection-fill"></i>',
                    'route' => null,
                    'permission' => null,
                    'permissions' => [
                        'departemen view',
                        'jabatan view'
                    ],
                    'submenus' => [
                        [
                            'title' => 'Departemen',
                            'route' => '/departments',
                            'permission' => 'departemen view'
                        ],
                        [
                            'title' => 'Jabatan',
                            'route' => '/positions',
                            'permission' => 'jabatan view'
                        ]
                    ]
                ]
            ]
        ],
        [
            'header' => 'Contacts',
            'permissions' => [
                'contact view'
            ],
            'menus' => [
                [
                    'title' => 'Kontak Masukan',
                    'icon' => '<i class="bi bi-envelope"></i>',
                    'route' => '/contacts',
                    'permission' => 'contact view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],
        [
            'header' => 'Users',
            'permissions' => [
                'user view',
                'role & permission view'
            ],
            'menus' => [
                [
                    'title' => 'User',
                    'icon' => '<i class="bi bi-people-fill"></i>',
                    'route' => '/users',
                    'permission' => 'user view',
                    'permissions' => [],
                    'submenus' => []
                ],
                [
                    'title' => 'Role & Permission',
                    'icon' => '<i class="bi bi-person-check-fill"></i>',
                    'route' => '/roles',
                    'permission' => 'role & permission view',
                    'permissions' => [],
                    'submenus' => []
                ]
            ]
        ],

    ]
];
