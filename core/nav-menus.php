<?php

/**
 * Atlas front end framework compatibility
 *
 * Modify the output of the wp_nav_menu function to make navigation menu(s)
 * compatible with the Atlas front end framework.
 */
add_action('init', function () {
    $nav = new \Castlegate\Apollo\Core\NavMenu('main-nav');
});

/**
 * Define navigation menus
 *
 * Define one or more navigation menus that can be edited in the WordPress
 * appearance settings.
 */
register_nav_menus([
    'main-nav' => 'Main Navigation',
]);
