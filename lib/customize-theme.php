<?php

function akvo_customize_register( $wp_customize ) {

   //All our sections, settings, and controls will be added here
	//kleuren
	$wp_customize->add_section( 'akvo_color' , array(
	    'title'      => __( 'Adjust colours', 'sage' ),
	    'priority'   => 30,
	    //'active_callback' => 'create_scss'
	) );
	//main
	$wp_customize->add_setting( 'main_color' , array(
	    'default'     => '#00a99d',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
		'label'        => __( 'Main Color', 'sage' ),
		'section'    => 'akvo_color',
		'settings'   => 'main_color',
	) ) );
	//bar
	$wp_customize->add_setting( 'info_bar_blog' , array(
	    'default'     => '#a3d165',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_blog', array(
		'label'        => __( 'Blog Post Color', 'sage' ),
		'section'    => 'akvo_color',
		'settings'   => 'info_bar_blog',
	) ) );
//bar
	$wp_customize->add_setting( 'info_bar_news' , array(
	    'default'     => '#f9ba41',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_news', array(
		'label'        => __( 'News Post Color', 'sage' ),
		'section'    => 'akvo_color',
		'settings'   => 'info_bar_news',
	) ) );
//bar
	$wp_customize->add_setting( 'info_bar_video' , array(
	    'default'     => '#f47b50',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_video', array(
		'label'        => __( 'Video Post Color', 'sage' ),
		'section'    => 'akvo_color',
		'settings'   => 'info_bar_video',
	) ) );
//bar
	$wp_customize->add_setting( 'info_bar_update' , array(
	    'default'     => '#54bce8',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_update', array(
		'label'        => __( 'Update Post Color', 'sage' ),
		'section'    => 'akvo_color',
		'settings'   => 'info_bar_update',
	) ) );

	//bar
	$wp_customize->add_setting( 'info_bar_page' , array(
	    'default'     => '#6d3a7d',
	    'transport'   => 'postMessage',
	    'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'info_bar_page', array(
		'label'        => __( 'Page Post Color', 'sage' ),
		'section'    => 'akvo_color',
		'settings'   => 'info_bar_page',
	) ) );

	//logo
	$wp_customize->add_section( 'akvo_logo_section' , array(
	    'title'       => __( 'Logo', 'sage' ),
	    'priority'    => 30,
	    'description' => 'Upload your logo',
	) );
	$wp_customize->add_setting( 'akvo_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'akvo_logo', array(
	    'label'    => __( 'Logo', 'sage' ),
	    'section'  => 'akvo_logo_section',
	    'settings' => 'akvo_logo',
	) ) );

	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'static_front_page');


}
add_action( 'customize_register', 'akvo_customize_register' );

// retrieves the attachment ID from the file URL
function pn_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}


function create_scss() {
	//global $wpdb;
	$file = WP_CONTENT_DIR."/themes/akvo-sites/assets/styles/common/_overrides.scss";
	$main_color = get_theme_mod('main_color');
	if (empty( $main_color )) $main_color = '#00a99d';

	$info_bar_blog = get_theme_mod('info_bar_blog');
	if (empty( $info_bar_blog )) $info_bar_blog = '#a3d165';

	$info_bar_news = get_theme_mod('info_bar_news');
	if (empty( $info_bar_news ))  $info_bar_news = '#f9ba41';

	$info_bar_video = get_theme_mod('info_bar_video');
	if (empty( $info_bar_video )) $info_bar_video = '#f47b50';

	$info_bar_update = get_theme_mod('info_bar_update');
	if (empty( $info_bar_update )) $info_bar_update = '#54bce8';

	$info_bar_page = get_theme_mod('info_bar_page');
	if (empty( $info_bar_page )) $info_bar_page = '#6d3a7d';

	$current = "\$brand-primary: $main_color;\n"
	."\$infobar-blog: $info_bar_blog;\n"
	."\$infobar-news: $info_bar_news;\n"
	."\$infobar-video: $info_bar_video;\n"
	."\$infobar-update: $info_bar_update;\n"
	."\$infobar-page: $info_bar_page;\n";
	// Write the contents back to the file
	file_put_contents($file, $current);
	return false;
}

// add_action( 'customize_save', 'create_scss' ); 

add_action( 'customize_save_after', 'create_scss' ); 

?>