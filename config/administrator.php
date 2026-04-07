<?php

return array(
    'uri' => 'admin',

    'domain' => '',
    //'title' => config('app.name'),
    'title' => env('APP_NAME', 'Laravel'),
    'model_config_path' => config_path('administrator'),
    'settings_config_path' => config_path('administrator/settings'),
    'menu' => [
        '用户管理' => [
            'users',
            'roles',
            'permissions'
        ],
        '内容管理'=>[
            'categories',
            'topics',
            'replies'
        ],
        '站点配置'=>[
            'settings.site',
            'links'
        ]
    ],
    'permission' => function () {
        return Auth::check() && Auth::user()->can('manage_contents');
    },
    'use_dashboard' => false,
    'dashboard_view' => '',
    'home_page' => 'users',
    'back_to_site_path' => '/',
    'login_path' => 'login',
    'logout_path' => false,
    'login_redirect_key' => 'redirect',
    'global_rows_per_page' => 20,
    'locales' => [],

    'custom_routes_file' => app_path('Http/routes/administrator.php'),
);
