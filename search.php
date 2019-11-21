<?php

/**
 * Search
 *
 * This file will display the search results. Note that search is still
 * available via a GET parameter even if this template is not defined and if the
 * search form is not displayed. To disable search completely, this file should
 * return a 404 response code.
 */

get_header();

?>

<div class="container my-5">
    <h1>Search: <?= get_search_query() ?></h1>

    <?php

    if (have_posts()) {
        while (have_posts()) {
            the_post();
            the_title('<h2><a href="' . get_permalink() . '">', '</a></h2>');
            the_excerpt();
        }
    } else {
        echo '<p>No posts found.</p>';
    }

    ?>
</div>

<?php

get_footer();
