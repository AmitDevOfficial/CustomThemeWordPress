<?php 
/*
    Template Name: Cart
*/
?>
<?php get_header(); ?>

<h1>Hey, this is the Cart Page</h1>

<!-- Add the WooCommerce Cart Shortcode -->
<?php echo do_shortcode('[woocommerce_cart]'); ?>

<?php get_footer(); ?>
