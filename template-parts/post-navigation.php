<?php
/**
 * Post navigation between articles.
 *
 * @package Hatteras
 */

$prev = get_previous_post();
$next = get_next_post();

if (!$prev && !$next) {
    return;
}
?>

<nav class="mx-auto max-w-3xl mt-16 pt-8 border-t border-inchiostro/10" aria-label="<?php esc_attr_e('Navigazione articoli', 'hatteras'); ?>">
    <div class="grid gap-8 md:grid-cols-2">
        <?php if ($prev): ?>
            <a href="<?php echo esc_url(get_permalink($prev)); ?>" class="post-nav-link !no-underline text-left">
                <span class="meta-caps"><?php esc_html_e('Capitolo precedente', 'hatteras'); ?></span>
                <strong><?php echo esc_html(get_the_title($prev)); ?></strong>
            </a>
        <?php else: ?>
            <span></span>
        <?php endif; ?>

        <?php if ($next): ?>
            <a href="<?php echo esc_url(get_permalink($next)); ?>" class="post-nav-link !no-underline text-right md:col-start-2">
                <span class="meta-caps"><?php esc_html_e('Capitolo successivo', 'hatteras'); ?></span>
                <strong><?php echo esc_html(get_the_title($next)); ?></strong>
            </a>
        <?php endif; ?>
    </div>
</nav>
