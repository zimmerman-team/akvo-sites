<?php

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'blog',
    array(
      'labels' => array(
        'name' => __( 'Blog posts' ),
        'singular_name' => __( 'Blog post' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-format-aside',
      'supports' => array(
        'title',
        'editor',
        'author', 
        'thumbnail', 
        'excerpt', 
        'comments', 
      ),
    )
  );

  register_post_type( 'video',
    array(
      'labels' => array(
        'name' => __( 'Videos' ),
        'singular_name' => __( 'Video' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-media-video',
      'supports' => array(
        'title',
        'editor',
        'author', 
        'thumbnail', 
        'excerpt', 
        'comments', 
      ),
    )
  );

}

?>