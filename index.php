<?php get_template_part('templates/page', 'header'); ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<?php 

if ( is_post_type_archive('media') ) $type = 'media';
elseif ( is_post_type_archive('blog') ) $type = 'blog';
elseif ( is_post_type_archive('video') ) $type = 'video';
else $type = 'post';

if ( $type != 'media' || $type != 'video' ) {

	//query voor sticky/featured voor in de top balk
	$args = array(
		'post_type' => $type,
		'posts_per_page' => 1,
		'meta_key'  => '_post_extra_boxes_checkbox',
		'meta_value' => 'on'
	);

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) : $query->the_post();
?>

<div class="col-md-12">
	<div class="row carousel eq clickable featured">
		<a href="<?php the_permalink(); ?>" class="boxlink"></a>
		<div class="col-sm-6 eq">
			<div class="text">
				<h1><?php echo get_the_title(); ?></h1>
				<?php the_excerpt(); ?>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="pic">
				<?php 
				if (has_post_thumbnail()) {
					the_post_thumbnail( 'large' ); 
				}
				else {
					?><img src="<?= get_template_directory_uri(); ?>/dist/images/placeholder800x400.jpg"><?php
				}
				?>
			</div>
		</div>
	</div>
</div>

	<?php endwhile; ?>
	

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	
<?php endif; ?>


<?php } ?>

<div class="col-md-3">
	<div class="filters">
		<h4>Filter</h4>
		<?php 
		if ( is_post_type_archive('blog') ) {
		 	echo do_shortcode( '[ULWPQSF id=48 formtitle=0]' );
		}
		elseif ( is_post_type_archive('media') ) {
		 	echo do_shortcode( '[ULWPQSF id=53 formtitle=0]' );
		}
		elseif ( is_post_type_archive('video') ) {
			echo do_shortcode( '[ULWPQSF id=53 formtitle=0]' );
		}
		else {
		 	echo do_shortcode( '[ULWPQSF id=49 formtitle=0]' );
		}
?>
	</div>
</div>

<div class="col-md-9">
	<div class="row" id="searchcontent">
<?php while (have_posts()) : the_post(); 
	if ( get_post_meta( get_the_ID(), '_post_extra_boxes_checkbox', true ) != 'on') {
  		get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format());
  	}
	endwhile; ?>
	</div>
</div>

<div class="col-md-12 text-center">
<?php wp_pagenavi(); ?>
</div>
