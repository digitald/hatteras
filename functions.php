<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

function hatteras_asset(string $path): string
{
    return get_template_directory_uri().'/assets/'.ltrim($path, '/');
}

function hatteras_body_classes(array $classes): array
{
    if (is_singular('post')) {
        return $classes;
    }

    if (is_404() || is_search()) {
        $classes[] = 'hatteras-watermark-strong';
        return $classes;
    }

    if (!is_singular()) {
        $classes[] = 'hatteras-watermark';
    }

    return $classes;
}
add_filter('body_class', 'hatteras_body_classes');

function hatteras_enqueue_fonts(): void
{
    wp_enqueue_style(
        'hatteras-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Source+Sans+3:wght@400;500&family=Source+Serif+4:ital,opsz,wght@0,8..60,400;0,8..60,600;1,8..60,400&display=swap',
        [],
        null
    );
}
add_action('wp_enqueue_scripts', 'hatteras_enqueue_fonts');
add_action('enqueue_block_editor_assets', 'hatteras_enqueue_fonts');

function hatteras_inline_styles(): void
{
    $watermark = hatteras_asset('images/map-watermark.webp');
    $pole = hatteras_asset('images/map-pole-crop.webp');
    $footer = hatteras_asset('images/background-footer.jpg');

    $css = sprintf(
        ':root{--hatteras-map-watermark:url(%1$s);--hatteras-map-pole:linear-gradient(to bottom,color-mix(in srgb,var(--color-pergamena) 94%%,transparent),var(--color-pergamena)),url(%2$s);--hatteras-map-footer:url(%3$s);}.hatteras-watermark{background-image:linear-gradient(to bottom,color-mix(in srgb,var(--color-pergamena) 72%%,transparent),color-mix(in srgb,var(--color-pergamena) 82%%,transparent)),var(--hatteras-map-watermark);}.hatteras-watermark-strong{background-image:linear-gradient(to bottom,color-mix(in srgb,var(--color-pergamena) 65%%,transparent),color-mix(in srgb,var(--color-pergamena) 78%%,transparent)),var(--hatteras-map-watermark);}',
        esc_url($watermark),
        esc_url($pole),
        esc_url($footer)
    );

    wp_register_style('hatteras-map', false);
    wp_enqueue_style('hatteras-map');
    wp_add_inline_style('hatteras-map', $css);
}
add_action('wp_enqueue_scripts', 'hatteras_inline_styles', 20);

function hatteras_reading_time(): string
{
    $content = get_post_field('post_content', get_the_ID());
    $words = str_word_count(wp_strip_all_tags((string) $content));
    $minutes = max(1, (int) ceil($words / 200));

    return sprintf(
        _n('%d min', '%d min', $minutes, 'hatteras'),
        $minutes
    );
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Framework\Assets\ViteCompiler, fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __('Menu principale', 'hatteras')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'html5' => [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        ]));
}

function hatteras_register_sidebars(): void
{
    register_sidebar([
        'name'          => __('Footer', 'hatteras'),
        'id'            => 'footer',
        'description'   => __('Area widget sopra il colophon del sito.', 'hatteras'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget__title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'hatteras_register_sidebars');

tailpress();
