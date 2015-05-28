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
      'taxonomies' => array('category'),
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
      //'taxonomies' => array('category'),
      'supports' => array(
        'title',
        'editor',
        //'thumbnail', 
        //'excerpt', 
      ),
    )
  );

  register_post_type( 'carousel',
    array(
      'labels' => array(
        'name' => __( 'Carousel items' ),
        'singular_name' => __( 'Carousel item' )
      ),
      'public' => true,
      'has_archive' => false,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-images-alt',
      'exclude_from_search' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail', 
      ),
    )
  );

  register_post_type( 'media',
    array(
      'labels' => array(
        'name' => __( 'Media items' ),
        'singular_name' => __( 'Media item' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-book',
      'taxonomies' => array('category'),
      'supports' => array(
        'title',
        'editor',
        'author', 
        'thumbnail', 
        'excerpt', 
      ),
    )
  );
}

function convertYoutubeImg($string) {
  return preg_replace(
    "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
    "http://i1.ytimg.com/vi/$2/mqdefault.jpg",
    $string
  );
}

function convertYoutube($string) {
  return preg_replace(
      "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
      "<iframe src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
      $string
    );
}

?>