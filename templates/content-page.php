<div class="col-md-12 article">
	<div class="bg">
        <div class="main-image">
          <img src="<?= get_template_directory_uri(); ?>/dist/images/placeholder800x400.jpg">
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
            	<?php use Roots\Sage\Titles; ?>
        		<h1><?= Titles\title(); ?></h1>
                <div class="entry-content">
                 	<?php the_content(); ?>
                </div>
            </div>
        </div>
	</div>
</div>