<?php
/**
 * Footer widget area.
 *
 * @package Hatteras
 */

if (!is_active_sidebar('footer')) {
    return;
}
?>

<section class="footer-widgets mb-10 pb-10 border-b border-inchiostro/10 max-w-full min-w-0 overflow-x-clip" aria-label="<?php esc_attr_e('Widget del footer', 'hatteras'); ?>">
    <?php dynamic_sidebar('footer'); ?>
</section>
