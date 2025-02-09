<?php
function fetch_movies_ajax_handler() {

     // Verify nonce for security
    check_ajax_referer('mm_ajax_nonce', 'security');

    $search_text = isset($_POST['search_text']) ? sanitize_text_field($_POST['search_text']) : '';
    $search_by = isset($_POST['search_by']) ? sanitize_text_field($_POST['search_by']) : '';
    $sort_by = isset($_POST['sort_by']) && in_array($_POST['sort_by'], ['ASC', 'DESC']) ? $_POST['sort_by'] : 'ASC';

    $args = [
        'post_type'      => 'movie',
        'post_status'    => 'publish',
        'posts_per_page' => -1, // Fetch all matching movies
        'orderby'        => 'title',
        'order'          => $sort_by,
    ];

    // If search text is provided
    if (!empty($search_text)) {
        if ($search_by) {
            $args['meta_query'] = [
                [
                    'key'     => $search_by,
                    'value'   => $search_text,
                    'compare' => 'LIKE'
                ]
            ];
        } else {
            $args['s'] = $search_text;
        }
    }

    $movies_query = new WP_Query($args);

    if ($movies_query->have_posts()) :
        $count = 1;
        while ($movies_query->have_posts()) : $movies_query->the_post();
            ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td>
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('thumbnail'); 
                    } else {
                        echo '<img src="' . plugin_dir_url(__FILE__) . 'assets/images/placeholder.jpg" alt="No Thumbnail" width="50">';
                    }
                    ?>
                </td>
                <td><?php the_title(); ?></td>
                <td><?php echo get_post_meta(get_the_ID(), 'mm_movies_actor_actress', true); ?></td>
                <td><?php echo get_post_meta(get_the_ID(), 'mm_movies_release_year', true); ?></td>
                <td><?php echo get_post_meta(get_the_ID(), 'mm_movies_release_date', true); ?></td>
                <td><?php echo get_post_meta(get_the_ID(), 'mm_movies_genre', true); ?></td>
                <td><?php echo get_post_meta(get_the_ID(), 'mm_movies_box_office_collection', true); ?></td>
            </tr>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<tr><td colspan="8" class="text-center">No movies found.</td></tr>';
    endif;

    wp_die();
}

add_action('wp_ajax_fetch_movies', 'fetch_movies_ajax_handler');
add_action('wp_ajax_nopriv_fetch_movies', 'fetch_movies_ajax_handler');
