<div class="<?= ATLAS_PREFIX ?>header">
    <h1 class="<?= ATLAS_PREFIX ?>header__title">
        <a href="<?= home_url('/') ?>" class="<?= ATLAS_PREFIX ?>header__title-link">
            <?= bloginfo('name') ?>
        </a>
    </h1>

    <div class="<?= ATLAS_PREFIX ?>header__nav">
        <?php

        wp_nav_menu([
            'theme_location' => 'main-nav',
        ]);

        ?>
    </div>
</div>
