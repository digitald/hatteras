<?php
/**
 * 404 template.
 *
 * @package Hatteras
 */

get_header();
?>

<div class="container mx-auto py-16 md:py-24">
    <?php get_template_part('template-parts/archive', 'header'); ?>

    <div class="max-w-md mx-auto text-center">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block mt-8 px-6 py-2 font-[family-name:var(--font-sans)] text-sm tracking-wide text-pergamena bg-nerofumo !no-underline hover:bg-inchiostro transition-colors">
            <?php esc_html_e('Torna alla base', 'hatteras'); ?>
        </a>
    </div>
</div>

<?php
get_footer();
