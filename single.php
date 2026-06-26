<?php
/**
 * Single post template file.
 *
 * @package Hatteras
 */

get_header();
?>

<div class="container mx-auto py-10 md:py-14">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('template-parts/content', 'single'); ?>
            <?php get_template_part('template-parts/post', 'navigation'); ?>

            <?php if (comments_open() || get_comments_number()): ?>
                <?php comments_template(); ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php
get_footer();
