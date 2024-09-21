<?php
/*
    Template Name: Blogs
*/
?>

<?php get_header(); ?>

<div class="container blogs">
    <h1><?php single_post_title(); ?></h1>

    <?php
    // Custom query to get blog posts
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 2, // Number of posts to display
        'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1 // Pagination support
    );
    $query = new WP_Query( $args );
    ?>

    <?php if ( $query->have_posts() ) : ?>
        <div class="post-list">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <article class="post">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="post-meta">
                        Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                    </div>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php
            $big = 999999999; // need an unlikely integer

            $pagination_args = array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'current'   => max( 1, get_query_var('paged') ),
                'total'     => $query->max_num_pages,
                'prev_text' => __( 'Previous', 'textdomain' ),
                'next_text' => __( 'Next', 'textdomain' ),
            );

            echo paginate_links( $pagination_args );
            ?>
        </div>

        <?php wp_reset_postdata(); // Reset query after custom loop ?>

    <?php else : ?>
        <p><?php _e( 'No posts found.', 'textdomain' ); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
