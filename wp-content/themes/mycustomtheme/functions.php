<?php



function mycustomtheme_files()

{

    wp_enqueue_style('main-styles', get_theme_file_uri('main.css'));
    wp_enqueue_style('custom-styles', get_theme_file_uri('custom.css'));
}



add_action('wp_enqueue_scripts', 'mycustomtheme_files');





function mycustomtheme_features()

{
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerMenuLocation', 'Footer Menu Location');
    add_theme_support('title-tag');
}



add_action('after_setup_theme', 'mycustomtheme_features');





function deregister_styles()

{

    wp_dequeue_style('wp-block-library');

    wp_dequeue_style('wp-block-library-theme');

    wp_dequeue_style('global-styles');

    wp_dequeue_style('classic-editor-styles');

    wp_dequeue_style('classic-theme-styles');
}



add_action('wp_print_styles', 'deregister_styles', 100);





remove_action('wp_head', 'rsd_link');

remove_action('wp_head', 'wp_generator');

remove_action('wp_head', 'feed_links', 2);

remove_action('wp_head', 'feed_links_extra', 3);

remove_action('wp_head', 'wlwmanifest_link');

remove_action('wp_head', 'adjacent_posts_rel_link');

remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

remove_action('wp_head', 'wp_admin_css', 10, 0);

remove_action('wp_head', 'rest_output_link_wp_head');

remove_action('wp_head', 'wp_oembed_add_discovery_links');

remove_action('wp_head', 'print_emoji_detection_script', 7);

remove_action('wp_print_styles', 'print_emoji_styles');

remove_filter('wp_robots', 'wp_robots_max_image_preview_large');





/* Disabling RSS feeds and removing RSS feed links */

function disable_feed()

{

    wp_die(__('Nothing here! Please go back to the <a href="' . esc_url(home_url('/')) . '">homepage</a>!'));
}

add_action('do_feed', 'disable_feed', 1);

add_action('do_feed_rdf', 'disable_feed', 1);

add_action('do_feed_rss', 'disable_feed', 1);

add_action('do_feed_rss2', 'disable_feed', 1);

add_action('do_feed_atom', 'disable_feed', 1);

add_action('do_feed_rss2_comments', 'disable_feed', 1);

add_action('do_feed_atom_comments', 'disable_feed', 1);


/* custom comments */
function my_custom_comments_callback($comment, $args, $depth)
{
?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment-list">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment, $size = '60'); ?>
                <div class="comment-details">
                    <?php printf(__('<cite class="comment-name">%s</cite> '), get_comment_author_link()) ?>
                    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>">
                            <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'), '  ', '') ?>
                    </div>
                </div>
            </div>

            <div class="comment-content">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.') ?></em>
                <?php else : ?>
                    <?php comment_text() ?>
                <?php endif; ?>
            </div>
            <div class="reply">
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        </div>
    <?php
}

function my_custom_comments_navigation()
{
    // Check for comment navigation.
    if (get_comment_pages_count() > 1 && get_option('page_comments')) {
        echo '<nav class="custom-comments-navigation" role="navigation">';
        echo '<div class="nav-links">';
        if ($prev_link = get_previous_comments_link(__('Older Comments'))) {
            printf('<div class="nav-previous">%s</div>', $prev_link);
        }
        if ($next_link = get_next_comments_link(__('Newer Comments'))) {
            printf('<div class="nav-next">%s</div>', $next_link);
        }
        echo '</div></nav>';
    }
}


function custom_get_comment_author_link($author_link)
{
    // Use preg_replace to remove the <a> tag, keeping only the author's name
    $author_name_only = preg_replace('/<a href="(.*)">(.*)<\/a>/', '\\2', $author_link);
    return $author_name_only;
}

// Add the filter to modify the get_comment_author_link output
add_filter('get_comment_author_link', 'custom_get_comment_author_link');
