<?php

/**
 * Theme features and definitions
 *
 * This file is executed by theme before any output is generated. It is used to
 * configure theme features and define constants and functions.
 */

/**
 * Load classes and functions
 *
 * Packages installed in the vendor directory by Composer and classes defined in
 * the classes directory with the correct theme namespace will be loaded by the
 * standard Composer autoload.php file.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Theme constants and functions
 *
 * Include files containing the definitions of constants used throughout the
 * theme and functions in the theme namespace.
 */
$atlas = json_decode(file_get_contents(__DIR__ . '/config.json'));

require_once __DIR__ . '/helpers/constants.php';
require_once __DIR__ . '/helpers/functions.php';

/**
 * Enqueue CSS and JavaScript
 *
 * Safely load CSS and JavaScript files for the theme and the classic content
 * editor using the standard WordPress enqueue functions.
 */
require_once __DIR__ . '/helpers/css.php';
require_once __DIR__ . '/helpers/javascript.php';
require_once __DIR__ . '/helpers/classic-editor-css.php';

/**
 * Theme features
 *
 * Configure theme features, including automatic title elements, featured
 * images, navigation menus, and image sizes.
 */
require_once __DIR__ . '/helpers/atlas-nav-menus.php';
require_once __DIR__ . '/helpers/icons.php';
require_once __DIR__ . '/helpers/image-sizes.php';
require_once __DIR__ . '/helpers/nav-menus.php';
require_once __DIR__ . '/helpers/theme-support.php';
