<?php
/**
 * Theme header template.
 *
 * @package Hatteras
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('antialiased'); ?>>
<?php do_action('tailpress_site_before'); ?>

<div id="page" class="min-h-screen flex flex-col">
    <?php do_action('tailpress_header'); ?>

    <header class="hatteras-header relative" role="banner">
        <div class="container mx-auto py-6 md:py-8">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <?php if (has_custom_logo()): ?>
                            <?php the_custom_logo(); ?>
                        <?php else: ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="!no-underline group">
                                <span class="block font-[family-name:var(--font-display)] text-2xl md:text-3xl font-semibold tracking-wide text-inchiostro group-hover:text-oro transition-colors">
                                    <?php bloginfo('name'); ?>
                                </span>
                                <?php if ($description = get_bloginfo('description')): ?>
                                    <span class="block mt-1 meta-caps"><?php echo esc_html($description); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if (has_nav_menu('primary')): ?>
                        <button
                            type="button"
                            aria-label="<?php esc_attr_e('Apri menu', 'hatteras'); ?>"
                            aria-expanded="false"
                            id="primary-menu-toggle"
                            class="md:hidden p-2 text-inchiostro"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>

                <div id="primary-navigation" class="hidden md:flex flex-col md:flex-row md:items-center mt-4 md:mt-0 w-full md:w-auto">
                    <div class="primary-navigation__panel engraved-border w-full md:w-auto flex flex-col md:flex-row md:items-center gap-6 md:gap-8">
                    <nav class="hatteras-nav" aria-label="<?php esc_attr_e('Menu principale', 'hatteras'); ?>">
                        <?php if (current_user_can('administrator') && !has_nav_menu('primary')): ?>
                            <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>" class="text-sm text-inchiostro-soft">
                                <?php esc_html_e('Configura menu', 'hatteras'); ?>
                            </a>
                        <?php else: ?>
                            <?php
                            wp_nav_menu([
                                'container_id'    => 'primary-menu',
                                'container_class' => '',
                                'menu_class'      => 'flex flex-col gap-4 md:flex-row md:gap-8',
                                'theme_location'  => 'primary',
                                'fallback_cb'     => false,
                            ]);
                            ?>
                        <?php endif; ?>
                    </nav>

                    <div class="hatteras-search shrink-0"><?php get_search_form(); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="content" class="site-content grow">
        <?php do_action('tailpress_content_start'); ?>
        <main>
