<?php

/**
 * Classic Editor CSS
 *
 * Enqueue additional CSS file(s) to provide alternative styles in the classic
 * content editor provided by the Classic Editor plugin. This may be used to
 * match the typography in the content editor to the typography on the front end
 * of the site.
 */
add_action('init', function () {
    add_editor_style(THEME_URL . '/dist/css/classic-editor-style.min.css');
});
