<?php

/**
 * Archive
 *
 * This file displays all archives, including categories, tags, dates, and
 * authors. It will also be used for custom post types, unless separate archive
 * templates are provided for those post types.
 */

get_header();

?>

<div class="container my-5">
    <?php

    the_archive_title('<h1>', '</h1>');

    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_title('<h2><a href="' . get_permalink() . '">', '</a></h2>');
            the_date(null, '<p class="text-secondary">', '</p>');
            the_excerpt();
        }
    }

    get_template_part('components/pagination/pagination');

    ?>
</div>

<?php

get_footer();
