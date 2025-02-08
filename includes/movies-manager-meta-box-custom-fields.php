<?php
// Register meta box fields
function mm_movies_meta_box_fields() {
    add_meta_box(
        'mm_movies_custom_fields',
        __('Movies Custom Fields', 'text-domain'),
        'mm_movies_custom_fields_callback',
        'movie'
    );
}
add_action('add_meta_boxes', 'mm_movies_meta_box_fields');

// Meta box and custom fields values
function mm_movies_custom_fields_callback($post) {
    wp_nonce_field(basename(__FILE__), 'mm_movies_nonce');

    $fields = [
        'mm_movies_actor_actress'        => 'Actor/Actress',
        'mm_movies_release_year'         => 'Release Year',
        'mm_movies_release_date'         => 'Release Date',
        'mm_movies_genre'                => 'Genre',
        'mm_movies_box_office_collection'=> 'Box Office Collection'
    ];

    foreach ($fields as $key => $label) {
        $value = get_post_meta($post->ID, $key, true);
        echo "<label for='{$key}'>" . esc_html__($label, 'text-domain') . ":</label><br>";
        
        $type = ($key === 'mm_movies_release_date') ? 'date' : 
                (($key === 'mm_movies_release_year') ? 'number' : 'text');
        
        echo "<input type='{$type}' id='{$key}' name='{$key}' value='" . esc_attr($value) . "' placeholder='" . esc_attr__('Enter ' . $label, 'text-domain') . "'><br><br>";
    }
}

// Save post meta fields values securely
function mm_save_post_meta($post_id) {
    // Prevent autosave, post revision, or unauthorized edits
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['mm_movies_nonce']) || !wp_verify_nonce($_POST['mm_movies_nonce'], basename(__FILE__))) return;

    // Define meta fields with sanitization rules
    $fields = [
        'mm_movies_actor_actress'         => 'sanitize_text_field',
        'mm_movies_release_year'          => 'intval',
        'mm_movies_release_date'          => 'sanitize_text_field',
        'mm_movies_genre'                 => 'sanitize_text_field',
        'mm_movies_box_office_collection' => 'floatval'
    ];

    // Loop through each field and update meta
    foreach ($fields as $key => $sanitize_function) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, call_user_func($sanitize_function, $_POST[$key]));
        }
    }
}
add_action('save_post', 'mm_save_post_meta');
