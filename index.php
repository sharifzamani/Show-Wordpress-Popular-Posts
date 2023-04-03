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
