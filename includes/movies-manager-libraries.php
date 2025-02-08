<?php
if (!function_exists('mm_movies_manager_libraries')) {
    function mm_movies_manager_libraries() {
        // Enqueue CSS
        wp_enqueue_style('mm-custom-style', plugin_dir_url(__FILE__) . '../assets/css/style.css', [], '1.0.0');

        // Enqueue Bootstrap CSS
        wp_enqueue_style('mm-bootstrap-style', plugin_dir_url(__FILE__) . '../assets/css/bootstrap.min.css', [], '5.0.0');

        // Enqueue JavaScript
        wp_enqueue_script('mm-custom-script', plugin_dir_url(__FILE__) . '../assets/js/script.js', ['jquery'], '1.0.0', true);

        // Enqueue Bootstrap JavaScript
        wp_enqueue_script('mm-bootstrap-script', plugin_dir_url(__FILE__) . '../assets/js/bootstrap.bundle.min.js', ['jquery'], '5.0.0', true);

        // Localize script for AJAX
        wp_localize_script('mm-custom-script', 'mm_ajax_plugin', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('mm_ajax_nonce') // Adding security nonce
        ]);
    }
}
add_action('wp_enqueue_scripts', 'mm_movies_manager_libraries');
