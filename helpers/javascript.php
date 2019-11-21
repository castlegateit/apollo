<?php

/**
 * Enqueue JavaScript
 *
 * Enqueue the main theme JavaScript file(s) via the Monolith enqueue function,
 * which provides automatic cache busting. Multiple JavaScript files can be
 * enqueued as an array of relative or absolute URLs.
 */
add_action('wp_enqueue_scripts', function () {
    \Castlegate\Monolith\WordPress\enqueue('dist/js/script.min.js');
});
