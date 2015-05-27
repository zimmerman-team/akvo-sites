<?php get_template_part('templates/page', 'header'); ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<?php 
if ( !is_post_type_archive('media') ) {
?>
<div class="col-md-12">
	<div class="row carousel eq">
		<div class="col-sm-6 eq">
			<div class="text">
				<h1>Welcome to the</h1>
				<h2>Akvo sites site editor</h2>
				<p>Start creating the most exciting and beautiful partner websites. They're easy to make and manage, take a look at our tutorial.</p>
				<a href="">read more</a>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="pic">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/placeholder800x400.jpg">
			</div>
		</div>
	</div>
</div>

<?php } ?>

<div class="col-md-3">
	<div class="filters">
		<h4>Filter results</h4>
	</div>
</div>

<div class="col-md-9">
	<div class="row">
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>
	</div>
</div>

<div class="col-md-12">
<?php the_posts_navigation(); ?>
</div>
