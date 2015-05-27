<div class="col-md-12 article">
	<div class="bg">
        <div class="main-image">
          <?php the_post_thumbnail( 'large' ); ?>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
            	<?php use Roots\Sage\Titles; ?>
        		<h1><?= Titles\title(); ?></h1>
            </div>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="entry-content dual">
                 	<?php the_content(); ?>
                </div>
            </div>
        </div>
	</div>
</div>