// wordpress popular posts
function custom_track_post_views($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if (!isset($count)) {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

add_action('wp_head', 'custom_track_post_views');
////////END///////////
