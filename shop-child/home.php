<?php 
    /*
    Template Name: Home
    */
?>
<?php get_header();?>
<h1>Hey this is Home page</h1>
<div class="pagination">
        <div class="nav-previous alignleft"><?php previous_posts_link( 'Older posts' ); ?></div>
        <div class="nav-next alignright"><?php next_posts_link( 'Newer posts' ); ?></div>

        </div>
<?php get_footer();?>

