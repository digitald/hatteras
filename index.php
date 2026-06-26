<?php
/**
 * Main template file for displaying posts.
 *
 * @package Hatteras
 */

get_header();
?>

<div class="container mx-auto py-10 md:py-14">
    <?php if (!is_singular() && (is_archive() || is_search() || is_home() && !is_front_page())): ?>
        <?php get_template_part('template-parts/archive', 'header'); ?>
    <?php endif; ?>

    <?php if (have_posts()): ?>
        <?php if (!is_singular()): ?>
            <div class="grid gap-10 md:grid-cols-2 md:gap-x-8 md:gap-y-14 max-w-5xl mx-auto">
                <?php while (have_posts()): the_post(); ?>
                    <?php get_template_part('template-parts/content'); ?>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('template-parts/content', is_singular() ? 'single' : ''); ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <div class="hatteras-pagination max-w-5xl mx-auto">
            <?php TailPress\Pagination::render(); ?>
        </div>
    <?php else: ?>
        <div class="max-w-3xl mx-auto text-center">
            <p class="text-inchiostro-soft text-lg">
                <?php esc_html_e('Nessuna rotta trovata.', 'hatteras'); ?>
            </p>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
