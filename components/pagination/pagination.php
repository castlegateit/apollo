<?php

$pagination = new \Castlegate\Apollo\Core\Pagination;
$links = $pagination->links();

if (!$links) {
    return;
}

?>

<ul class="pagination justify-content-center my-5">
    <?php

    foreach ($links as $link) {
        $classes = ['page-item'];

        if ($link->current) {
            $classes[] = 'active';
        }

        if (!$link->link) {
            $classes[] = 'disabled';
        }

        if ($link->url) {
            ?>
            <li class="<?= implode(' ', $classes) ?>">
                <a href="<?= $link->url ?>" class="page-link">
                    <?= $link->text ?>
                </a>
            </li>
            <?php

            continue;
        }

        ?>
        <li class="<?= implode(' ', $classes) ?>">
            <span class="page-link">
                <?= $link->text ?>
            </span>
        </li>
        <?php
    }

    ?>
</ul>
