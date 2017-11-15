<?php
return [

    /**
     * Backend plugin route path
     */
    'Backend.path' => '/backend',

    /**
     * Backend theme name
     */
    'Backend.theme' => null,

    'Backend.Theme.Navbar.enabled' => true,
    'Backend.Theme.Sidebar.enabled' => true,

    'Backend.Theme.Navbar' => ['panels' => ['Backend.Navbar\Messages', 'Backend.Navbar\Notifications', 'Backend.Navbar\User']],
    'Backend.Theme.Sidebar' => [],

    /**
     * Backend Dashboard
     *
     * - title: Dashboard title string
     * - url: Url to Dashboard
     */
    'Backend.Dashboard.title' => 'Backend',
    'Backend.Dashboard.url' => ['plugin' => 'Backend', 'controller' => 'Dashboard', 'action' => 'index'],

    /**
     * Backend Security
     *
     * - enabled: Enables SecurityComponent
     * - forceSSL: Force https scheme for all backend requests
     */
    'Backend.Security.enabled' => false,
    'Backend.Security.forceSSL' => false,

    /**
     * Backend AuthComponent config
     */
    'Backend.Auth' => [],

    /**
     * Backend Search config
     */
    'Backend.Search.searchUrl' => ['plugin' => 'Backend', 'controller' => 'Search', 'action' => 'index'],

    /**
     * Backend AdminLTE theme options
     */
    'Backend.AdminLte.skin_class' => 'skin-blue',
    'Backend.AdminLte.layout_class' => '',
    'Backend.AdminLte.sidebare_class' => 'sidebar-mini',

    'Backend.services' => [
        'Backend.LayoutNavbar' => true,
        'Backend.LayoutSidebar' => true,
        'Backend.LayoutToolbar' => true,
    ]
];
