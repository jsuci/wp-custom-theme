<?php


function add_custom_acf_meta_tags()
{
    // Check if the function exists and the current post has a valid ID
    if (function_exists('get_field') && is_singular()) {
        $post_id = get_the_ID();

        // Retrieve ACF field value
        $post_description = get_field('post_description', $post_id);
        $meta_description = substr($post_description, 0, 160);

        // Check if the field has a value and output it
        if ($meta_description) {
            echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
        }
    }
}

// Add the function to the wp_head action
add_action('wp_head', 'add_custom_acf_meta_tags');
