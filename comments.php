<?php
/**
 * Comments template.
 *
 * @package Hatteras
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mx-auto max-w-3xl mt-16 pt-10 border-t border-inchiostro/10">
    <?php if (have_comments()): ?>
        <h2 class="comments-title text-2xl font-semibold text-inchiostro mb-8 font-[family-name:var(--font-display)]">
            <?php
            printf(
                esc_html(_nx(
                    'Un commento',
                    '%1$s commenti',
                    get_comments_number(),
                    'comments title',
                    'hatteras'
                )),
                esc_html(number_format_i18n(get_comments_number()))
            );
            ?>
        </h2>

        <ol class="comment-list [&_.children]:ml-10 [&_.children_>_li]:mt-6 mb-10">
            <?php
            wp_list_comments([
                'format'      => 'html5',
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'walker'      => new \TailPress\Walkers\CommentWalker(),
            ]);
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav class="comment-navigation flex justify-between text-sm mb-8" aria-label="<?php esc_attr_e('Navigazione commenti', 'hatteras'); ?>">
                <div class="nav-previous">
                    <?php previous_comments_link(esc_html__('Commenti precedenti &larr;', 'hatteras')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(esc_html__('Commenti successivi &rarr;', 'hatteras')); ?>
                </div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments text-inchiostro-soft"><?php esc_html_e('I commenti sono chiusi.', 'hatteras'); ?></p>
    <?php endif; ?>

    <?php
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? ' aria-required="true"' : '');

        comment_form([
            'fields' => apply_filters('comment_form_default_fields', [
                'author' =>
                    '<p class="comment-form-author">' .
                    '<input id="author" class="w-full px-4 py-3 mb-3 text-sm" placeholder="' . esc_attr__('Nome*', 'hatteras') . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                    '" size="30"' . $aria_req . ' /></p>',

                'email' =>
                    '<p class="comment-form-email">' .
                    '<input id="email" class="w-full px-4 py-3 mb-3 text-sm" placeholder="' . esc_attr__('Email*', 'hatteras') . '" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) .
                    '" size="30"' . $aria_req . ' /></p>',

                'url' =>
                    '<p class="comment-form-url">' .
                    '<input id="url" class="w-full px-4 py-3 mb-3 text-sm" placeholder="' . esc_attr__('Sito web', 'hatteras') . '" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) .
                    '" size="30" /></p>'
            ]),
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-xl font-semibold mb-4 font-[family-name:var(--font-display)]">',
            'class_submit'      => 'px-5 py-2 text-sm tracking-wide',
            'comment_field'     => '<textarea id="comment" name="comment" class="w-full px-4 py-3 mb-3 text-sm" aria-required="true" rows="5" placeholder="' . esc_attr__('Il tuo commento', 'hatteras') . '"></textarea>',
            'logged_in_as'      => '<p class="logged-in-as mb-4 text-sm text-inchiostro-soft">',
        ]);
    ?>
</div>
