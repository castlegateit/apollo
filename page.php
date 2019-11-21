<?php

/**
 * Page
 *
 * This file will display page content unless a page template with a matching
 * slug or ID is provided or if the user has selected a different, selectable
 * page template.
 */

get_header();
the_post();

?>

<div class="container my-5">
    <?php

    the_title('<h1>', '</h1>');
    the_content();

    ?>
</div>

<?php

get_footer();
