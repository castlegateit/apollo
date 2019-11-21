<?php

/**
 * Single
 *
 * This file will be used to display a single post or a single item in a custom
 * post type, unless a specific template has been provided for that post type.
 */

get_header();
the_post();

?>

<div class="container my-5">
    <?php

    the_title('<h1>', '</h1>');
    the_date(null, '<p class="text-secondary">', '</p>');
    the_content();

    ?>
</div>

<?php

get_footer();
