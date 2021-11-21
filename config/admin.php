<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Super admin user
    |--------------------------------------------------------------------------
    |
    | Assign defaults whenever needed
    | 
    */

    'super_admin_username'      => env('SUPER_ADMIN_USERNAME', ''),
    'super_admin_email'     => env('SUPER_ADMIN_EMAIL', ''),
    'super_admin_password'  => env('SUPER_ADMIN_PASSWORD', ''),

    /*
    |--------------------------------------------------------------------------
    | Admin users
    |--------------------------------------------------------------------------
    |
    | Assign defaults whenever needed
    | 
    */

    # Special Admin
    'special_admin_username'    => 'sadmin',
    'special_admin_email'   => 'sadmin@simple.lara',
    'special_admin_password'=> 'q%aC?7V$ye*=D_Yr',

    # R&D Tech Admin
    'tech_admin_username'       => 'tech_admin',
    'tech_admin_email'      => 'tech@simple.lara',
    'tech_admin_password'   => '9tc7T#xFN2DexK*D',

    # CS Admin
    'cs_admin_username'         => 'cs_admin',
    'cs_admin_email'        => 'cs@simple.lara',
    'cs_admin_password'     => 'L75BQ!YT!ytD#9HB',

    # Finance Admin
    'fin_admin_username'        => 'fin_admin',
    'fin_admin_email'       => 'fin@simple.lara',
    'fin_admin_password'    => 'rp$^P8PEpbR2C4P8',

    # Logistics and Operations Admin
    'ops_admin_username'        => 'ops_admin',
    'ops_admin_email'       => 'ops@simple.lara',
    'ops_admin_password'    => 'L5-bJVN7776hp$E7',

    # Products Admin
    'prod_admin_username'       => 'prod_admin',
    'prod_admin_email'      => 'prod@simple.lara',
    'prod_admin_password'   => '@-xH398Gt_-4!%_v',

    # Users Admin
    'user_admin_username'       => 'user_admin',
    'user_admin_email'      => 'user@simple.lara',
    'user_admin_password'   => '@_6qCuCR=r=%bTKt',

    ];