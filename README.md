# Show-Wordpress-Popular-Posts
Here is a sample code for showing popular WordPress posts
For Show Wordpress Popular Posts without using plugin you should insert this code in functions.php:
----------------------------------

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

----------------------------------
This code creates a new instance of the WP_Query class and retrieves 5 popular posts based on the post_views_count meta field. The posts are then sorted in descending order and looped through to display the title and permalink of each post. Finally, the query is reset using the wp_reset_query() function.

Note that you will need to have a plugin or some code in place to track post views and store the counts in the post_views_count meta field in order for this code to work.

and insert This code In index.php or other:
----------------------------------


<ul>
<?php
$popularpost = new WP_Query(
    array(
        'posts_per_page' => 5,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    )
);
while ($popularpost->have_posts()) : $popularpost->the_post();
?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; wp_reset_query(); ?>
</ul>

----------------------------------
This code creates a function custom_track_post_views that runs on the wp_head action. It checks if the current page is a single post, retrieves or sets the post view count from the post_views_count meta field, increments the count, and updates the meta field.

You can add this code in your WordPress theme's functions.php file, or create a new custom plugin for it. Now that you have this code running, the previous code in our answer will be able to retrieve the popular posts based on the post view counts.

finish... :)

