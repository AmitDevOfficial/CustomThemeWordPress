<h1>hey i am footer</h1>

<?php wp_footer(); ?>

<script>
    jQuery(document).ready(function($) {
    $('#s').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                dataType: 'json',
                data: {
                    action: 'search_suggestions',
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2
    });
});

</script>
</body>
</html>
