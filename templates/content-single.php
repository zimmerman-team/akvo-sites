<div class="col-md-9">
  <?php while (have_posts()) : the_post(); 
  $type = get_post_type();
  ?>
  <article <?php post_class(); ?>>
    <div class="bg">
      <div class="main-image">
        <?php 
        if (in_array($type, array('video','testimonial'), true )) {
          $url = convertYoutube(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
          ?>
          <div class='embed-container'>
            <?php echo $url; ?>
          </div>
          <?php
        }
        elseif ($type == 'map') {

        }
        else the_post_thumbnail( 'large' );       
        ?>
      </div>
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>
        </div>
        <div class="col-lg-12">
          <div class="meta">
            <div class="row">
              <div class="col-lg-10 col-lg-offset-1">
                <?php get_template_part('templates/entry-meta'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-10 col-lg-offset-1">
          <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
              <div class="entry-content">
                <?php the_content();
                if ($type == 'media') {
                  $id = get_the_ID();
                  $author = get_post_meta( $id, '_media_lib_author', true );
                  $dld = get_post_meta( $id, '_media_lib_file', true );
                  $location = get_the_terms( $id, 'countries' );
                  $language = get_the_terms( $id, 'languages' );
                  $category = get_the_terms( $id, 'category' );
                  $type_tax = get_the_terms( $id, 'types' );
                  if (!empty($author)) { ?>
                  <p><b>Author</b>: <?php echo $author;?></p>
                  <?php } 
                  if (!empty($location)) { ?>
                  <p><b>Location</b>: <?php 
                  foreach($location as $loc) {
                    echo $loc->name;
                  }
                  ?></p>
                  <?php }
                  if (!empty($language)) { ?>
                  <p><b>Language</b>: <?php 
                  foreach($language as $lang) {
                    echo $lang->name;
                  }
                  ?></p>
                  <?php }
                  if (!empty($category)) { ?>
                  <p><b>Category</b>: <?php 
                  foreach($category as $cat) {
                    echo $cat->name;
                  }
                  ?></p>
                  <?php }
                  if (!empty($type_tax)) { ?>
                  <p><b>Type</b>: <?php 
                  foreach($type_tax as $type) {
                    echo $type->name;
                  }
                  ?></p>
                  <?php } ?>
                  <p><a href="<?php echo $dld; ?>" class="btn btn-default">Download</a></p>
                  <?php
                }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer> -->
    <?php if ($type == 'post' || $type == 'blog') { ?>
    <div class="bg">
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <?php comments_template('/templates/comments.php'); ?>
        </div>
      </div>
    </div>
    <?php } ?>

  </article>
</div>
<?php endwhile; ?>

<div class="col-md-3">
  <div class="related">
    <?php
    $attached = get_post_meta( get_the_ID(), 'attached_cmb2_attached_posts', true );
    if(!empty($attached)) {
    ?>
    <h2 class="head">Related posts</h2>
    <div class="row">
    <?php 
    $the_query = new WP_Query( array( 
      'post__in' => $attached,
      'post_type' => 'any' 
    ) );
    if ( $the_query->have_posts() ) :
      while ( $the_query->have_posts() ) : $the_query->the_post();
        $type = get_post_type();
        if ($type == 'post') $type = 'news';
        blokmaker(12, $type);
      endwhile;
      wp_reset_postdata();
    endif;
    } ?>
    </div>
  </div>
</div>

