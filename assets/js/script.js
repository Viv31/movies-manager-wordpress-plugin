jQuery(document).ready(function($) {
    
    function fetchMovies() {
        var searchText = $("#mm_search_by_text").val();
        var searchBy = $("#search_by_meta_fields").val();
        var sortBy = $("#sort_by_az_za").val();

        $.ajax({
            url:  mm_ajax_plugin.ajax_url, // Use localized AJAX URL,
            type: "POST",
            data: {
                action: "fetch_movies",
                security: mm_ajax_plugin.nonce, // Nonce for security
                search_text: searchText,
                search_by: searchBy,
                sort_by: sortBy,
            },
            beforeSend: function() {
                $(".table tbody").html('<tr><td colspan="8" class="text-center">Loading...</td></tr>');
            },
            success: function(response) {
                $(".table tbody").html(response);
            }
        });
    }

    jQuery("#mm_search_by_text, #search_by_meta_fields, #sort_by_az_za").on("input change", function() {
        fetchMovies();
    });

    // Load more button (optional)
    jQuery(".btn-warning").on("click", function() {
        fetchMovies();
    });
});

