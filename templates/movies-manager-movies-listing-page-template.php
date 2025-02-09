<?php 
/**
 * Template Name: Movies Manager Movies Listing  
 */
get_header();

// Fetch movie posts
$args = [
    'post_type'      => 'movie',
    'post_status'    => 'publish',
    'posts_per_page' => 1
];

$movies_query = new WP_Query($args);

//error_reporting(0);

include plugin_dir_url(__FILE__).'../include/movies-manager-filters.php';
include plugin_dir_url(__FILE__).'/../assets/js/script.js';
?>

<div class="container-fluid">
    <div class="container"> 
        <div class="row shadow mb-3">
            <div class="col-md-12">
                <h2 class="my-4">Movies List</h2>
            </div>
        </div>
        <div class="row shadow mb-3">
            <div class="col-md-4 mb-3">
                <div class="form-group mt-3">
                    <input type="text" name="mm_search_by_text" id="mm_search_by_text" class="form-control" placeholder="Type Here">
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group mt-3">
                    <select class="form-control" name="search_by_meta_fields" id="search_by_meta_fields">
                        <option value="">--- Search By ---</option>
                        <option value="mm_movies_actor_actress">Actor/Actress</option>
                        <option value="mm_movies_release_year">Release Year</option>
                        <option value="mm_movies_release_date">Release Date</option>
                        <option value="mm_movies_genre">Genre</option>
                        <option value="mm_movies_box_office_collection">Collection</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="form-group mt-3">
                    <select class="form-control" name="sort_by_az_za" id="sort_by_az_za">
                        <option value="">--- Sort By ---</option>
                        <option value="ASC">AZ</option>
                        <option value="DESC">ZA</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                    <tbody id="movies-list">
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
                <button type="button" class="btn btn-warning mt-3">Load More</button>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
