<?php


use App\Enums\MobilPermissionsEnum;
use Rezyon\Applications\Hotels\Enums\PermissionEnums;
use Rezyon\Applications\Supplier\Enums\PermissionsEnum as SupplierPermissionsEnum;
use Rezyon\Applications\TourismCompany\Enums\PermissionsEnum as TourismPermissionsEnum;
use Rezyon\Applications\Packages\Enums\AdminPermissionsEnum as AdminPackagesPermissionsEnum;
use Rezyon\Applications\Companies\Enums\AdminPermissionsEnum as AdminCompaniesPermissionsEnum;

return [
    [
        "title" => 'sidebar.dashboard',
        "route" => null,
        'permissions' => []
    ],
    [
        "title" => 'sidebar.companies',
        'permissions' => [
            AdminCompaniesPermissionsEnum::ADMIN_SHOW->value
        ],
        'submenu' => [
            [
                'title'=>'sidebar.all_companies',
                'route'=>'companies.all',
                'permissions' => [
                    AdminCompaniesPermissionsEnum::ADMIN_SHOW->value
                ],
            ],
            [
                'title' =>'sidebar.companies_waiting_for_approval',
                'route' => 'application.companies::getWaitingApproval',
                'permissions' => [
                    AdminCompaniesPermissionsEnum::ADMIN_SHOW_WAITING_APPROVE->value
                ]
            ],
            [
                'title' =>'sidebar.domain_list',
                'route' => 'domains.view.list',
                'permissions' => [
                    AdminCompaniesPermissionsEnum::ADMIN_DOMAIN_LIST->value
                ]
            ]
        ]
    ],
    [
        "title" => 'Transferler',
        'permissions' => [

        ],
        'submenu' => [
            [
                'title'=>'Araçlar',
                'permissions' => [

                ],
                'submenu' => [
                    [
                        'title'=>'Araç Listesi',
                        'route'=>'cars.index',
                        'permissions' => [

                        ]
                    ],
                    [
                        'title'=>'Araç Ekle',
                        'route'=>'cars.create',
                        'permissions' => [

                        ]
                    ],
                ]
            ],
            [
                'title'=>'Transferler',
                'permissions' => [

                ],
                'submenu' => [
                    [
                        'title'=>'Transfer Listesi',
                        'route'=>'transfers.index',
                        'permissions' => [

                        ]
                    ],
                    [
                        'title'=>'Transfer Ekle',
                        'route'=>'transfers.create',
                        'permissions' => [

                        ]
                    ],
                ]
            ],
        ]
    ],
    [
        "title" => 'sidebar.hotels',
        'permissions' => [
            \Rezyon\Applications\Hotels\Enums\AdminPermissionEnums::ADMIN_HOTELS_LIST->value
        ],
        'submenu' => [
            [
                'title'=>'sidebar.hotels.list',
                'route'=>'hotels.index',
                'permissions' => [
                    \Rezyon\Applications\Hotels\Enums\AdminPermissionEnums::ADMIN_HOTELS_LIST->value
                ]
            ],
            [
                'title'=>'sidebar.hotels.add',
                'route'=>'hotels.create',
                'permissions' => [
                    \Rezyon\Applications\Hotels\Enums\AdminPermissionEnums::ADMIN_HOTELS_ADD->value
                ]
            ],
        ]
    ],
    [
        "title" => 'sidebar.packages',
        'permissions' => [
            AdminPackagesPermissionsEnum::ADMIN_PACKAGE_LIST->value
        ],
        'submenu' => [
            [
                'title'=>'sidebar.all_packages',
                'route'=>'packages.view.list',
                'permissions' => [
                    AdminPackagesPermissionsEnum::ADMIN_PACKAGE_LIST->value
                ]
            ],
            [
                'title'=>'sidebar.create_package',
                'route'=>'packages.view.create',
                'permissions' => [
                    AdminPackagesPermissionsEnum::ADMIN_PACKAGE_STORE->value
                ]
            ],
        ]
    ],
    [
        "title" => 'sidebar.activities',
        'permissions' => [
            SupplierPermissionsEnum::SUPPLIER_ACTIVITY_LIST->value,
            TourismPermissionsEnum::TOURISM_ACTIVITY_LIST->value
        ],
        'submenu' => [
            [
                'title' => 'sidebar.my_activities',
                'route' => 'supplier.activity.list',
                'permissions' => [
                    SupplierPermissionsEnum::SUPPLIER_ACTIVITY_LIST->value
                ]
            ],
            [
                'title' => 'sidebar.waiting_for_pool_approval',
                'route' => 'supplier.activity.pool.pending'
            ],
            [
                'title' =>'sidebar.create_activity',
                'route' => 'supplier.activity.add',
                'permissions' => [
                    SupplierPermissionsEnum::SUPPLIER_ACTIVITY_STORE->value
                ]
            ],
            [
                'title' =>'sidebar.my_activity_pool',
                'route' => 'tourism.activity.pool',
                'permissions' => [
                    TourismPermissionsEnum::TOURISM_ACTIVITY_LIST->value
                ]
            ]
        ]
    ],
    [
        "title" => 'sidebar.users',
        'permissions' => [],
        'submenu' => [
            [
                'title' => 'sidebar.user_add',
                'route' => 'company.users.add',
                'permissions' => [
                    TourismPermissionsEnum::TOURISM_SUBUSER_STORE->value,
                    SupplierPermissionsEnum::SUPPLIER_SUBUSER_STORE->value,
                ]
            ],
        ]
    ],

    /**
     * @description Turizm firmaları müşteri (son kullanıcı) eklemek için bu alanı kullanır.
     */
    [
        "title" => 'sidebar.customers',
        'permissions' => [
            TourismPermissionsEnum::TOURISM_SUBUSER_STORE->value,
        ],
        'submenu' => [
            [
                'title' => 'sidebar.customer_list',
                'route' => 'company.customer.viewList',
                'permissions' => [
                    TourismPermissionsEnum::TOURISM_SUBUSER_STORE->value,
                ]
            ],
            [
                'title' => 'sidebar.customer_add',
                'route' => 'company.customer.viewAdd',
                'permissions' => [
                    TourismPermissionsEnum::TOURISM_SUBUSER_STORE->value,
                ]
            ],
        ]
    ],

    /**
     * @description Mobil Uygulama Ayarları
     */
    [
        "title" => 'sidebar.mobil_setting',
        'permissions' => null,
        'submenu' => [
            [
                'title' => 'sidebar.mobil_version',
                'route' => 'mobil.app.version',
                'permissions' => []
            ],
        ]
    ],



];
