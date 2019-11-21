<?php

/**
 * Search form
 *
 * Standard WordPress search form template. This will be displayed anywhere the
 * get_search_form function is called.
 */

?>

<form action="<?= home_url('/') ?>" method="get">
    <div class="form-row">
        <div class="col-auto">
            <label for="search-term" class="sr-only">Search</label>
            <input type="search" name="s" id="search-term" class="form-control" placeholder="Search" value="<?= get_search_query() ?>">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>
