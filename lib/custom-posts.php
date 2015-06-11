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
        'name' => __( 'Carousel' ),
        'singular_name' => __( 'Carousel slide' )
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
        'name' => __( 'Media library' ),
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
        'thumbnail', 
      ),
    )
  );

  register_post_type( 'testimonial',
    array(
      'labels' => array(
        'name' => __( 'Testimonials' ),
        'singular_name' => __( 'Testimonial' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-megaphone',
      'supports' => array(
        'title',
        'editor',
        'author', 
        'thumbnail', 
        'excerpt', 
      ),
    )
  );

  register_post_type( 'poject',
    array(
      'labels' => array(
        'name' => __( 'Project updates' ),
        'singular_name' => __( 'Project update' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-hammer',
      'supports' => array(
        'title',
        'editor',
        'author', 
        'thumbnail', 
        'excerpt', 
      ),
    )
  );

  register_post_type( 'flow',
    array(
      'labels' => array(
        'name' => __( 'AKVO Flow' ),
        'singular_name' => __( 'Flow item' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'supports' => array(
        'title',
        'editor',
        'author', 
        'thumbnail', 
        'excerpt', 
      ),
    )
  );

  register_post_type( 'map',
    array(
      'labels' => array(
        'name' => __( 'Maps' ),
        'singular_name' => __( 'Map' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-location-alt',
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

function truncate($string, $length, $stopanywhere=false) {
    //truncates a string to a certain char length, stopping on a word if not specified otherwise.
    if (strlen($string) > $length) {
        //limit hit!
        $string = substr($string,0,($length -3));
        if ($stopanywhere) {
            //stop anywhere
            $string .= '...';
        } else{
            //stop on a word.
            $string = substr($string,0,strrpos($string,' ')).'...';
        }
    }
    return $string;
}

function blokmaker($cols, $types) {

  if ($types == 'video') {
    $thumb = convertYoutubeImg(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
    $thumb = '<img src="'.$thumb.'">';
  }
  elseif ($types == 'media') {
    $filename = get_post_meta( get_the_ID(), '_media_lib_file', true );
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext == 'pdf') $fa = 'fa-file-pdf-o';
    elseif (in_array($ext, array('doc','docx'), true )) $fa = 'fa-file-word-o';
    elseif (in_array($ext, array('xls','xlsx'), true )) $fa = 'fa-file-excel-o';
    elseif (in_array($ext, array('ppt','pptx'), true )) $fa = 'fa-file-powerpoint-o';
    elseif (in_array($ext, array('zip','rar','7z'), true )) $fa = 'fa-file-archive-o';
    else $fa = 'fa-file-o';
    $thumb = '<div class="icon-wrap"><i class="fa fa-inverse fa-4x '.$fa.'"></i></div>';
  }
  else {
    if (has_post_thumbnail()) {
      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumb-medium', true);
      $thumb = $thumb_url_array[0];
      $thumb = '<img src="'.$thumb.'">';
    }
    else {
      $thumb = get_template_directory_uri().'/dist/images/placeholder800x400-320x180.jpg';
      $thumb = '<img src="'.$thumb.'">';
    }
  }
  $type = $types;
  if ($types == 'post') $type = 'news';

  if ($cols == 12) $size = 'megagroot';
  elseif ($cols == 6) $size = 'middel';
  elseif ($cols == 9) $size = 'groot';
  else $size = 'klein';
  $title = get_the_title();
  $title = truncate($title,10);
  ?>
  <div class="col-md-<?php echo $cols; ?> eq">
    <div class="box-wrap <?php echo $size; ?> <?php if(is_front_page()) echo 'home'; ?>">
      <a href="<?php the_permalink(); ?>" class="boxlink"></a>
      <div class="header-wrap">
        <h2><?php echo $title; ?></h2>
      </div>
      <div <?php post_class('infobar'); ?>>
        <time class="updated date" datetime="<?= get_the_time('c'); ?>"><?= get_the_date(); ?></time>
        <span class="type"><?php echo $type; ?></span>
      </div>
      <?php echo $thumb; ?>
      <div class="excerpt">
        <?php the_advanced_excerpt(); ?>
      </div>
    </div>
  </div>
  <?php
}

add_action( 'after_setup_theme', 'akvo_custom_thumbnail_size' );
function akvo_custom_thumbnail_size(){
    add_image_size( 'thumb-small', 224, 126, true ); // Hard crop to exact dimensions (crops sides or top and bottom)
    add_image_size( 'thumb-medium', 320, 180, true ); 
    add_image_size( 'thumb-large', 480, 480, true );
}

?>