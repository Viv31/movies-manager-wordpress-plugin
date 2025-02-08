jQuery(document).ready(function($) {
    $('#ajax-button').on('click', function() {
        var name = $('#name-input').val(); // Get input value

        $.ajax({
            type: 'POST',
            url: mm_ajax_plugin.ajax_url, // Use localized AJAX URL
            data: {
                action: 'mm_custom_action', // Action hook for PHP
                security: mm_ajax_plugin.nonce, // Nonce for security
                name: name // Send user input
            },
            beforeSend: function() {
                $('#ajax-button').text('Processing...').prop('disabled', true);
            },
            success: function(response) {
                $('#ajax-response').html('<p>' + response.message + '</p>');
                console.log(response); // Debugging
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#ajax-response').html('<p style="color:red;">AJAX request failed.</p>');
            },
            complete: function() {
                $('#ajax-button').text('Send AJAX').prop('disabled', false);
            }
        });
    });
});
