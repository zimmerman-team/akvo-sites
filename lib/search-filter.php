<?php
add_filter('uwpqsf_result_tempt', 'customize_output', '', 4);
function customize_output($results , $arg, $id, $getdata ){
	 // The Query
            $apiclass = new uwpqsfprocess();
             $query = new WP_Query( $arg );
		ob_start();	$result = '';
			// The Loop

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();global $post;
				$type = get_post_type();
				if ($type == 'post') $type = 'news';
				if ($type == 'video') {
					$thumb = convertYoutubeImg(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
				}
				else {
					if (has_post_thumbnail()) {
						$thumb_id = get_post_thumbnail_id();
						$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
						$thumb = $thumb_url_array[0];
					}
					else {
						$thumb = get_template_directory_uri().'/dist/images/placeholder800x400.jpg';
					}
				}
				?>
					<div class="col-md-4 eq">
						<div class="box-wrap">
							<a href="<?php the_permalink(); ?>" class="boxlink"></a>
							<h2><?php the_title(); ?></h2>
							<div <?php post_class('infobar'); ?>>
								<time class="updated date" datetime="<?= get_the_time('c'); ?>"><?= get_the_date(); ?></time>
								<span class="type"><?php echo $type; ?></span>
							</div>
							<img src="<?php echo $thumb; ?>">
							<div class="excerpt">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
				<?php
			}
                        echo  $apiclass->ajax_pagination($arg['paged'],$query->max_num_pages, 4, $id, $getdata);
		 } else {
					 echo  '<div class="col-md-12"><h2 style="margin-top:0;">Nothing found</h2></div>';
				}
				/* Restore original Post Data */
				wp_reset_postdata();

		$results = ob_get_clean();		
			return $results;
}
?>
