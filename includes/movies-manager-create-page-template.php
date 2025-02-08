<?php
register_activation_hook(__FILE__, 'ctp_create_custom_pages');

function ctp_create_custom_pages() {
    $pages = [
        'movies-manager-movies-listing' => [
            'title'    => 'Movies Manager Movies Listing',
            'template' => 'movies-manager-movies-listing-page-template.php',
        ],
        'movies-manager-watch-list' => [
            'title'    => 'Movies Manager Watch List',
            'template' => 'movies-manager-watchlist-page-template.php',
        ],
    ];

    foreach ($pages as $slug => $data) {
        if (!get_page_by_path($slug)) {
            $page_id = wp_insert_post([
                'post_title'   => $data['title'],
                'post_content' => 'This is a custom template page.',
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ]);

            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        }
    }
}

// Register custom templates
add_filter('theme_page_templates', 'ctp_register_custom_templates');
function ctp_register_custom_templates($templates) {
    $custom_templates = [
        'movies-manager-movies-listing-page-template.php' => 'Movies Manager Movies Listing',
        'movies-manager-watchlist-page-template.php'      => 'Movies Manager Watch List',
    ];

    return array_merge($templates, $custom_templates);
}

// Load custom template
add_filter('template_include', 'ctp_load_custom_template');
function ctp_load_custom_template($template) {
    $templates = [
        'movies-manager-movies-listing' => 'movies-manager-movies-listing-page-template.php',
        'movies-manager-watch-list'     => 'movies-manager-watchlist-page-template.php',
    ];

    foreach ($templates as $slug => $file) {
        if (is_page($slug)) {
            $custom_template = plugin_dir_path(__FILE__) . '/templates/' . $file;
            if (file_exists($custom_template)) {
                return $custom_template;
            }
        }
    }

    return $template;
}
