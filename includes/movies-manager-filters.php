<?php

// AJAX handler for logged-in users
add_action('wp_ajax_mm_custom_action', 'mm_custom_ajax_handler');
// AJAX handler for guests (non-logged-in users)
add_action('wp_ajax_nopriv_mm_custom_action', 'mm_custom_ajax_handler');

function mm_custom_ajax_handler() {
    // Verify nonce for security
    check_ajax_referer('mm_ajax_nonce', 'security');

    // Get data from AJAX request
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';

    // Example response
    $response = [
        'message' => 'Hello, ' . esc_html($name) . '! Your AJAX request was successful.',
        'status'  => 'success'
    ];

    // Send JSON response
    wp_send_json($response);
}
