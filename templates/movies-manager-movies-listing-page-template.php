<?php 
/**
 * Template Name: Movies Manager Movies Listing  
 */
get_header();

// Fetch movie posts
$args = [
    'post_type'      => 'movie',
    'post_status'    => 'publish',
    'posts_per_page' => -1
];

$movies_query = new WP_Query($args);

error_reporting(0);
?>

<div class="container-fluid">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center my-4">Movies List</h2>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Poster</th>  <!-- Added a column for Thumbnail -->
                            <th>Title</th>
                            <th>Actor/Actress</th>
                            <th>Release Year</th>
                            <th>Release Date</th>
                            <th>Genre</th>
                            <th>Box Office Collection (CR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($movies_query->have_posts()) :
                            $count = 1;
                            while ($movies_query->have_posts()) : $movies_query->the_post();
                                ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td>
                                        <?php 
                                        if (has_post_thumbnail()) {
                                            // Display the post thumbnail (using size 'thumbnail' or 'medium' as needed)
                                            the_post_thumbnail('thumbnail'); 
                                        } else {
                                            // Display a placeholder if no thumbnail exists
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
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">No movies found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
