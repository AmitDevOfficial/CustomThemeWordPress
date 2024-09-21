<?php get_header(); ?>

<div class="content-area">
    <main class="site-main">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <span class="posted-on"><?php echo get_the_date(); ?></span>
                </footer>
            </article>
        <?php endwhile; endif; ?>

    </main>
</div>

<?php get_footer(); ?>
