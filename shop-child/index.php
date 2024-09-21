<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WooCommerce Product Categories</title>
    <?php wp_head(); ?>
</head>
<body>
    <?php get_header(); ?>
    <div class="mainContent">
        <h2>Hey I am Main Content</h2>
    </div>
    <div class="container">
    <h1>Product Categories</h1>

    <?php wp_list_categories( array('taxonomy' => 'product_cat', 'title_li'  => '') );?>

    </div>
    <?php get_footer(); ?>
    <?php wp_footer(); ?>
</body>
</html>
