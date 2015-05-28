<?php while (have_posts()) : the_post(); ?>
  <div class="col-md-9">
    <article <?php post_class(); ?>>
      <div class="bg">
        <div class="main-image">
          <?php 
          if (get_post_type() == 'video') {
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
                  <?php the_content(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <footer>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </footer> -->
      <div class="bg">
        <div class="row">
          <div class="col-lg-10 col-lg-offset-1">
              <?php comments_template('/templates/comments.php'); ?>
          </div>
        </div>
      </div>

    </article>
  </div>
<?php endwhile; ?>
