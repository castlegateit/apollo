<?php

/**
 * Enqueue CSS
 *
 * Enqueue the main theme CSS file(s) via the Monolith enqueue function, which
 * provides automatic cache busting. Multiple CSS files can be enqueued as an
 * array of relative or absolute URLs.
 */
add_action('wp_enqueue_scripts', function () {
    \Castlegate\Monolith\WordPress\enqueue('dist/css/style.min.css');
});
