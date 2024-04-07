<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Check if the post is password protected
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h4 class="comments-title">
            <?php
            $comments_number = get_comments_number();

            printf(
                esc_html(_nx('One comment', '%1$s comments', $comments_number, 'text-domain')),
                number_format_i18n($comments_number)
            );
            ?>
        </h4>

        <ol class="comment-list">
            <?php
            wp_list_comments(array('callback' => 'my_custom_comments_callback'));
            ?>
        </ol>

        <?php my_custom_comments_navigation(); ?>

        <?php if (!comments_open()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'text-domain'); ?></p>
        <?php endif; ?>

    <?php endif; // Check for have_comments(). 
    ?>

    <?php
    comment_form(array(
        'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h4>',
        'fields'               => array(
            'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245"' . ($req ? ' required="required"' : '') . ' placeholder="' . __('Enter your name') . '" /></p>',
            'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100"' . ($req ? ' required="required"' : '') . ' placeholder="' . __('Enter your email') . '" /></p>',
        ),
        'label_submit'         => __('Post Comment'), // Customize the submit button text
        'class_submit'         => 'submit-button-class mt-3 px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50', // Add a custom class to the submit button
        'comment_field'        => '<p class="comment-form-comment"><textarea id="comment-custom-id" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="' . __('Enter your comment here...') . '"></textarea></p>',

        // Additional options remain unchanged
        'class_form'           => 'custom-comment-form-class',
        'title_reply'          => __('Leave a Comment'),
        'cancel_reply_link'    => __('Cancel Comment'),
        'comment_notes_before' => '<p class="comment-notes">' . __('Thanks for choosing to leave a comment. Please keep in mind that all comments are moderated according to our comment policy, and your email address will NOT be published.') . '</p>',
        'id_form'              => 'commentform-custom-id',
        'id_comment'           => 'comment-custom-id',
    ));
    ?>

</div><!-- #comments -->