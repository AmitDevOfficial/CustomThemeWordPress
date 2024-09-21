<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <?php
            // Start the loop to display the current post
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
                
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h1 class="post-title"><?php the_title(); ?></h1>
                        
                        <div class="post-meta">
                            <p>Published on: <?php echo get_the_date(); ?> by <?php the_author(); ?></p>
                            <p>Category: <?php the_category( ', ' ); ?></p>
                            <p><?php the_tags( 'Tags: ', ', ', '<br>' ); ?></p>
                        </div>
                        
                        <div class="post-content">
                            <?php the_content(); // Displays the post content ?>
                        </div>
                        
                        <div class="post-navigation">
                            <div class="prev-post">
                                <?php previous_post_link( '%link', 'Previous Post: %title' ); ?>
                            </div>
                            <div class="next-post">
                                <?php next_post_link( '%link', 'Next Post: %title' ); ?>
                            </div>
                        </div>

                        <?php
                        // Comments template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                    </article>

                <?php endwhile; // End of the loop
            else :
                echo '<p>' . __( 'No posts found.' ) . '</p>';
            endif;
            ?>
        </div>  
    </div>
</div>

<?php get_footer(); ?>
