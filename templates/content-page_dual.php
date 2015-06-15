<?php 
$yt = get_post_meta( get_the_ID(), '_channels_youtube', true );
$flickr = get_post_meta( get_the_ID(), '_channels_flickr', true );
$flickr_handle = get_post_meta( get_the_ID(), '_channels_flickr_handle', true );

?>

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
            <div class="col-lg-8 col-lg-offset-2">
                <div class="meta single"></div>
            </div>
            <div class="col-lg-10 col-lg-offset-1">
                <div class="entry-content dual">
                 	<?php the_content(); ?>
                </div>
            </div>

            <?php if (!empty($yt)) { ?>
            <div class="col-lg-12">
                <?php echo do_shortcode($yt); ?>
            </div>
            <?php } ?>

            <?php if (!empty($flickr)) { ?>
            <div class="col-lg-12">
                <?php echo show_flickr($flickr,$flickr_handle); ?>
            </div>
            <?php } ?>

        </div>
	</div>
</div>