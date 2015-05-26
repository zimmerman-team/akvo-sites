<header class="banner" role="banner">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <a class="brand" href="<?= esc_url(home_url('/')); ?>">
          <?php //bloginfo('name'); ?>
          <img src="<?= get_template_directory_uri(); ?>/dist/images/logo-sample.svg">
        </a>
      </div>
      <div class="col-md-6">
        <?php get_template_part('templates/searchform'); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 navi">
        <nav role="navigation">
          <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
          endif;
          ?>
          <span class="lang">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa-stack-1x fa-inverse">NL</i>
            </span>
          </span>

        </nav>
      </div>
    </div>
  </div>
</header>
