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

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
            <i class="fa fa-bars fa-2x"></i>
          </button>
        </div>
        
        <nav class="collapse navbar-collapse" role="navigation">

          <?php
          if (has_nav_menu('primary_navigation')) :
            wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
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
    <?php if ( !is_front_page() )  { ?> 
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
          <?php if(function_exists('bcn_display'))
          {
              bcn_display();
          }?>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</header>
