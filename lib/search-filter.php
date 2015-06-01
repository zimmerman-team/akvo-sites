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
				if ( get_post_meta( get_the_ID(), '_post_extra_boxes_checkbox', true ) != 'on') blokmaker(4, $type);
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
