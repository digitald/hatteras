<article id="post-<?php the_ID(); ?>" <?php post_class('vignette-card engraved-border p-6 md:p-8'); ?>>
    <?php if (has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>" class="block mb-5 !no-underline overflow-hidden" tabindex="-1" aria-hidden="true">
            <?php the_post_thumbnail('medium_large', [
                'class' => 'w-full aspect-3/2 object-cover grayscale-[30%] hover:grayscale-0 transition-[filter] duration-500',
            ]); ?>
        </a>
    <?php endif; ?>

    <header>
        <?php
        $categories = get_the_category();
        if ($categories):
        ?>
            <p class="category-label mb-2">
                <?php echo esc_html($categories[0]->name); ?>
            </p>
        <?php endif; ?>

        <h2 class="vignette-card__title text-2xl font-semibold text-inchiostro transition-colors">
            <a href="<?php the_permalink(); ?>" class="!no-underline"><?php the_title(); ?></a>
        </h2>

        <p class="mt-3 meta-caps">
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished">
                <?php echo esc_html(get_the_date()); ?>
            </time>
            <span aria-hidden="true"> · </span>
            <?php echo esc_html(hatteras_reading_time()); ?>
        </p>
    </header>

    <div class="mt-4 text-inchiostro-soft leading-relaxed text-base">
        <?php the_excerpt(); ?>
    </div>

    <footer class="mt-6">
        <a
            href="<?php the_permalink(); ?>"
            class="post-nav-link !no-underline"
            aria-label="<?php echo esc_attr(sprintf(__('Continua a leggere: %s', 'hatteras'), get_the_title())); ?>"
        >
            <?php esc_html_e('Continua a leggere', 'hatteras'); ?> →
        </a>
    </footer>
</article>
