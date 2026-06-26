<?php
/**
 * Archive / search page header.
 *
 * @package Hatteras
 */
?>

<header class="cartouche mx-auto max-w-3xl mb-12 md:mb-16">
    <?php if (is_search()): ?>
        <p class="category-label mb-3"><?php esc_html_e('Esplorazione', 'hatteras'); ?></p>
        <h1 class="text-3xl md:text-4xl font-semibold text-inchiostro">
            <?php
            printf(
                esc_html__('Risultati per: %s', 'hatteras'),
                esc_html(get_search_query())
            );
            ?>
        </h1>
    <?php elseif (is_404()): ?>
        <p class="category-label mb-3"><?php esc_html_e('Regione inesplorata', 'hatteras'); ?></p>
        <h1 class="text-3xl md:text-4xl font-semibold text-inchiostro">
            <?php esc_html_e('Pagina non trovata', 'hatteras'); ?>
        </h1>
        <p class="mt-4 text-inchiostro-soft">
            <?php esc_html_e('Nessuna rotta conduce a questa destinazione.', 'hatteras'); ?>
        </p>
    <?php else: ?>
        <p class="category-label mb-3"><?php esc_html_e('Archivio', 'hatteras'); ?></p>
        <h1 class="text-3xl md:text-4xl font-semibold text-inchiostro">
            <?php the_archive_title(); ?>
        </h1>
        <?php if (get_the_archive_description()): ?>
            <div class="mt-4 text-inchiostro-soft leading-relaxed">
                <?php the_archive_description(); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</header>
