<div class="col-md-9">
  <?php while (have_posts()) : the_post(); 
  $type = get_post_type();
  ?>
  <article <?php post_class(); ?>>
    <div class="bg">
      <div class="main-image">
        <?php 
        if ($type == 'video') {
          $url = convertYoutube(get_post_meta( get_the_ID(), '_video_extra_boxes_url', true ));
          ?>
          <div class='embed-container'>
            <?php echo $url; ?>
          </div>
          <?php
        }

        else the_post_thumbnail( 'large' ); 
        
        ?>
      </div>
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>
          <div class="meta">
            <?php get_template_part('templates/entry-meta'); ?>
          </div>
          <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
              <div class="entry-content">
                <?php the_content();
                if ($type == 'media') {
                  $dld = get_post_meta( get_the_ID(), '_media_lib_file', true );
                  ?>
                  <a href="<?php echo $dld; ?>">Download here</a>
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
    <?php if ($type == 'post' || $type == 'post') { ?>
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

