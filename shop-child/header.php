<?php wp_head();?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand"  href="<?php echo esc_url( home_url( '/' ) ); ?>">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <?php
            wp_nav_menu( array( 
                'theme_location' => 'primary-menu',
                'container' => false, // We don't need an extra <nav> container here
                'menu_class' => 'navbar-nav', // Bootstrap's class for the <ul> element
                'add_li_class' => 'nav-item', // Add 'nav-item' to each <li>

            ) );
        ?>

        </li>
      </ul>
      <form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="s"><?php _e('Search for:', 'domain'); ?></label>
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" autocomplete="off" />
    <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x('Search', 'submit button'); ?>" />
</form>



    </div>
  </div>
</nav>


<?php wp_footer();?>