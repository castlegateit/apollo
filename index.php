<?php

/**
 * Index
 *
 * This file displays the main list of posts when home.php does not exist. It
 * also acts as a fallback for any other templates that do not exist.
 */

get_header();

?>

<div class="container my-5">
    <h1>Posts</h1>

    <?php

    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_title('<h2><a href="' . get_permalink() . '">', '</a></h2>');
            the_date(null, '<p class="text-secondary">', '</p>');
            the_excerpt();
        }
    }

    ?>
</div>

<?php

get_footer();
