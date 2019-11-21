<?php

/**
 * Atlas front end framework compatibility
 *
 * Modify the output of the wp_nav_menu function to make navigation menu(s)
 * compatible with the Atlas front end framework.
 */
add_action('init', function () {
    $nav = new \Castlegate\Apollo\NavMenu;
});
