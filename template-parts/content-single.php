<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="mx-auto max-w-3xl text-center cartouche">
        <?php
        $categories = get_the_category();
        if ($categories):
        ?>
            <p class="category-label mb-3">
                <?php echo esc_html($categories[0]->name); ?>
            </p>
        <?php endif; ?>

        <h1 class="text-3xl md:text-4xl font-semibold text-inchiostro [text-wrap:balance]">
            <?php the_title(); ?>
        </h1>

        <?php if (!is_page()): ?>
            <p class="mt-4 meta-caps">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" itemprop="datePublished">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
                <span aria-hidden="true"> · </span>
                <?php echo esc_html(hatteras_reading_time()); ?>
                <span aria-hidden="true"> · </span>
                <?php the_author(); ?>
            </p>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail()): ?>
        <figure class="mx-auto max-w-3xl mt-10 engraved-border overflow-hidden">
            <?php the_post_thumbnail('large', ['class' => 'w-full object-cover']); ?>
        </figure>
    <?php endif; ?>

    <div class="entry-content drop-cap mx-auto max-w-3xl mt-10 md:mt-14">
        <?php the_content(); ?>
    </div>

    <?php
    wp_link_pages([
        'before'      => '<nav class="mx-auto max-w-3xl mt-8 meta-caps" aria-label="' . esc_attr__('Pagine articolo', 'hatteras') . '"><p class="mb-2">' . esc_html__('Pagine:', 'hatteras') . '</p>',
        'after'       => '</nav>',
        'link_before' => '<span class="inline-block px-2">',
        'link_after'  => '</span>',
    ]);
    ?>
</article>
