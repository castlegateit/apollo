<?php

/**
 * Fallback navigation menu
 *
 * If no navigation menu has been defined for the main-nav theme location, this
 * menu will be shown instead. It lists all top level pages with a menu_order
 * less than 1000.
 */

$pages = get_pages([
    'child_of' => 0,
    'parent' => 0,
    'sort_column' => 'menu_order',
    'sort_order' => 'ASC',
]);

if (!$pages) {
    return;
}

// Remove pages from the list with menu_order values greater than 1000. This
// provides a crude method for excluding pages from the navigation menu.
$pages = array_filter($pages, function ($page) {
    return $page->menu_order < 1000;
});

if (!$pages) {
    return;
}

// Default classes and active link class.
$default_item_classes = [
    ATLAS_PREFIX . 'header__nav-item',
    ATLAS_PREFIX . 'header__nav-item--level-1',
];

$default_link_classes = [
    ATLAS_PREFIX . 'header__nav-link',
    ATLAS_PREFIX . 'header__nav-link--level-1',
];

$active_class = ATLAS_PREFIX . 'header__nav-link--level-1-active';

?>

<ul class="<?= ATLAS_PREFIX ?>header__nav-list <?= ATLAS_PREFIX ?>header__nav-list--level-1">
    <?php

    // Link to home page (if home page is not a top level page)
    if (get_option('show_on_front') != 'page') {
        $home_link_classes = $default_link_classes;

        if (is_home()) {
            $home_link_classes[] = $active_class;
        }

        ?>
        <li class="<?= implode(' ', $default_item_classes) ?>">
            <a href="<?= home_url('/') ?>" class="<?= implode(' ', $home_link_classes) ?>">
                Home
            </a>
        </li>
        <?php
    }

    // Links to top level pages
    foreach ($pages as $page) {
        $link_classes = $default_link_classes;

        if ($page->ID == get_the_ID()) {
            $link_classes[] = $active_class;
        }

        ?>
        <li class="<?= implode(' ', $default_item_classes) ?>">
            <a href="<?= get_permalink($page) ?>" class="<?= implode(' ', $link_classes) ?>">
                <?= get_the_title($page) ?>
            </a>
        </li>
        <?php
    }

    ?>
</ul>
