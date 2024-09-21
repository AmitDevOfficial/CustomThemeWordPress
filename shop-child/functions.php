<?php 
function enqueue_parent_styles() {

        wp_enqueue_style( 'parent-style', get_template_directory_uri(). '/style.css' );
        wp_enqueue_style('child-style' ,  get_stylesheet_directory_uri().  '/style.css');

        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
        wp_enqueue_style('fontawesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
        // wp_enqueue_style('w3-css', 'https://www.w3schools.com/w3css/4/w3.css');
        wp_enqueue_script('bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '4.5.2');
        }
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_jquery_ui() {
        wp_enqueue_script('jquery-ui-autocomplete');
        wp_enqueue_style('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    }
    add_action('wp_enqueue_scripts', 'enqueue_jquery_ui');
    
    

register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'myfirsttheme' ),
        'secondary' => __( 'Secondary Menu', 'myfirsttheme' )
    ) );


    

add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'editor-styles' );
add_theme_support( 'html5', array( 'style','script' ) );
add_theme_support( 'automatic-feed-links' ); 


// Enqueue AJAX script
function enqueue_search_suggestions_script() {
        wp_enqueue_script('search-suggestions', get_template_directory_uri() . '/js/search-suggestions.js', array('jquery'), null, true);
    
        // Localize script with AJAX URL
        wp_localize_script('search-suggestions', 'custom_search_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ));
    }
    add_action('wp_enqueue_scripts', 'enqueue_search_suggestions_script');
    
    // AJAX handler for search suggestions
    function get_search_suggestions() {
        global $wpdb;
    
        $term = sanitize_text_field($_POST['term']);
    
        $suggestions = $wpdb->get_results($wpdb->prepare(
            "SELECT post_title FROM $wpdb->posts WHERE post_title LIKE %s AND post_status = 'publish'",
            '%' . $wpdb->esc_like($term) . '%'
        ));
    
        if ($suggestions) {
            foreach ($suggestions as $suggestion) {
                echo '<div>' . esc_html($suggestion->post_title) . '</div>';
            }
        } else {
            echo 'No suggestions found.';
        }
    
        wp_die(); // Required to terminate immediately and return a proper response
    }
    add_action('wp_ajax_get_search_suggestions', 'get_search_suggestions');
    add_action('wp_ajax_nopriv_get_search_suggestions', 'get_search_suggestions');

    
    function custom_search_query($query) {
        if ($query->is_search && !is_admin()) {
            // Custom query modifications here
        }
        return $query;
    }
    add_filter('pre_get_posts', 'custom_search_query');
    

    function search_suggestions() {
        global $wpdb;
        
        $term = sanitize_text_field($_GET['term']);
        $suggestions = [];
    
        if (!empty($term)) {
            $query = $wpdb->prepare("
                SELECT post_title 
                FROM $wpdb->posts 
                WHERE post_title LIKE %s
                AND post_status = 'publish'
                LIMIT 10", '%' . $wpdb->esc_like($term) . '%');
            
            $results = $wpdb->get_results($query);
    
            if ($results) {
                foreach ($results as $result) {
                    $suggestions[] = $result->post_title;
                }
            }
        }
    
        wp_send_json($suggestions);
    }
    
    add_action('wp_ajax_search_suggestions', 'search_suggestions');
    add_action('wp_ajax_nopriv_search_suggestions', 'search_suggestions');

    
//     Custom Post Type



        
        function custom_post_type_and_taxo() {
                // Register Custom Post Type: Books
                $post_type_args = array(
                    'label' => 'Books',
                    'public' => true,
                    'supports' => array( 'title', 'editor', 'thumbnail' ),
                    'has_archive' => true,
                    'rewrite' => array( 'slug' => 'books' ),
                );
                register_post_type( 'books', $post_type_args );
            

                $post_type_args = array(
                        'label' => 'Cook',
                        'public' => true,
                        'supports' => array( 'title', 'editor', 'thumbnail' ),
                        'has_archive' => true,
                        'rewrite' => array( 'slug' => 'cook' ),
                    );
                    register_post_type( 'cook', $post_type_args );


                // Register Custom Taxonomy: Genre
                $taxonomy_args = array(
                    'labels' => array(
                        'name' => 'Genres',
                        'singular_name' => 'Genre',
                    ),
                    'public' => true,
                    'hierarchical' => true,
                    'show_ui' => true,
                    'show_in_menu' => true,
                    'rewrite' => array( 'slug' => 'genre' ),
                );
                register_taxonomy( 'genre', 'books', $taxonomy_args );

                $taxonomy_args = array(
                        'labels' => array(
                            'name' => 'Book List',
                            'singular_name' => 'Book',
                        ),
                        'public' => true,
                        'hierarchical' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'rewrite' => array( 'slug' => 'booklist' ),
                    );
                    register_taxonomy( 'booklist', 'books', $taxonomy_args );
            }
            add_action( 'init', 'custom_post_type_and_taxo' );
            
// Custom shortcode to display categories with clickable links
function custom_category_list() {
    ob_start();
    ?>
    <ul>
    <?php
    $categories = get_categories(array(
        'hide_empty' => true // Hide categories that have no posts
    ));
    foreach ($categories as $category) {
        echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
    }
    ?>
    </ul>
    <?php
    return ob_get_clean();
}
add_shortcode('category_list', 'custom_category_list');

            ?>