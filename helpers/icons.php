<?php

/**
 * Icons
 *
 * Add link(s) to site icon(s) provided by the theme. These should act as a
 * standards-compliant and mobile-friendly alternative to a favicon.ico file in
 * the site root directory.
 */
add_action('wp_head', function () {
    get_template_part('components/fragments/icons');
});
