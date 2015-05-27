<div class="col-md-4 eq">
	<div class="box-wrap">
		<a href="<?php the_permalink(); ?>" class="boxlink"></a>
		<h2><?php the_title(); ?></h2>
		<div <?php post_class('infobar'); ?>>
			<time class="updated date" datetime="<?= get_the_time('c'); ?>"><?= get_the_date(); ?></time>
			<span class="type"><?php echo get_post_type(); ?></span>
		</div>
		<?php the_post_thumbnail( 'thumb' ); ?>
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>
