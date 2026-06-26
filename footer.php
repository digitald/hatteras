<?php
/**
 * Theme footer template.
 *
 * @package Hatteras
 */
?>
        </main>

        <?php do_action('tailpress_content_end'); ?>
    </div>

    <?php do_action('tailpress_content_after'); ?>

    <footer id="colophon" class="hatteras-footer mt-16" role="contentinfo">
        <div class="container mx-auto py-10 md:py-12">
            <?php do_action('tailpress_footer'); ?>

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between text-sm text-inchiostro-soft font-[family-name:var(--font-sans)]">
                <p>
                    &copy; <?php echo esc_html(date_i18n('Y')); ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="!no-underline hover:text-oro"><?php bloginfo('name'); ?></a>
                </p>

                <p class="meta-caps">
                    <a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" class="!no-underline hover:text-oro">
                        <?php esc_html_e('Feed RSS', 'hatteras'); ?>
                    </a>
                </p>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
